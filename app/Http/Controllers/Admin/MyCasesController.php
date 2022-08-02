<?php

namespace App\Http\Controllers\Admin;

use App\Events\MyCaseStatusChangedEvent;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMyCaseRequest;
use App\Http\Requests\StoreMyCaseRequest;
use App\Http\Requests\UpdateMyCaseRequest;
use App\Models\Area;
use App\Models\CasesCategory;
use App\Models\CaseStatus;
use App\Models\Complaint;
use App\Models\MyCase;
use App\Models\User;
use Carbon\Carbon;
use Faker\Provider\ar_EG\Company;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MyCasesController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('my_case_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MyCase::with(['complaints', 'category', 'status', 'handle_by', 'report_to', 'from_area', 'created_by'])->select(sprintf('%s.*', (new MyCase())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'my_case_show';
                $editGate = 'my_case_edit';
                $deleteGate = 'my_case_delete';
                $crudRoutePart = 'my-cases';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('case_no', function ($row) {
                return $row->case_no ? $row->case_no : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->editColumn('complaint', function ($row) {
                $labels = [];
                foreach ($row->complaints as $complaint) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $complaint->title);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('category_title', function ($row) {
                return $row->category ? $row->category->title : '';
            });

            $table->editColumn('image', function ($row) {
                if (!$row->image) {
                    return '';
                }
                $links = [];
                foreach ($row->image as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->addColumn('handle_by_name', function ($row) {
                return $row->handle_by ? $row->handle_by->name : '';
            });

            $table->editColumn('handle_by.email', function ($row) {
                return $row->handle_by ? (is_string($row->handle_by) ? $row->handle_by : $row->handle_by->email) : '';
            });
            $table->addColumn('report_to_name', function ($row) {
                return $row->report_to ? $row->report_to->name : '';
            });

            $table->editColumn('report_to.email', function ($row) {
                return $row->report_to ? (is_string($row->report_to) ? $row->report_to : $row->report_to->email) : '';
            });
            $table->addColumn('from_area_name', function ($row) {
                return $row->from_area ? $row->from_area->name : '';
            });

            $table->addColumn('created_by_name', function ($row) {
                return $row->created_by ? $row->created_by->name : '';
            });

            $table->editColumn('created_by.email', function ($row) {
                return $row->created_by ? (is_string($row->created_by) ? $row->created_by : $row->created_by->email) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'complaint', 'category', 'image', 'status', 'handle_by', 'report_to', 'from_area', 'created_by']);

            return $table->make(true);
        }

        $complaints       = Complaint::get();
        $cases_categories = CasesCategory::get();
        $case_statuses    = CaseStatus::get();
        $users            = User::get();
        $areas            = Area::get();

        return view('admin.myCases.index', compact('complaints', 'cases_categories', 'case_statuses', 'users', 'areas'));
    }

    public function create()
    {
        abort_if(Gate::denies('my_case_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaints = Complaint::pluck('title', 'id');

        $categories = CasesCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = CaseStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $handle_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $report_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.myCases.create', compact('categories', 'complaints', 'handle_bies', 'report_tos', 'statuses'));
    }

    public function store(StoreMyCaseRequest $request)
    {
        $myCase = MyCase::create($request->all());
        $myCase->complaints()->sync($request->input('complaints', []));

        // CS stand for MyCase
        $myCase->case_no = Carbon::now()->format('Ymd') . 'CS' . sprintf('%04d', $myCase->id);
        $myCase->save();

        foreach ($request->input('image', []) as $file) {
            $myCase->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $myCase->id]);
        }

        $savedCase = MyCase::find($myCase->id);
        MyCaseStatusChangedEvent::dispatch($savedCase);

        return redirect()->route('admin.my-cases.index');
    }

    public function edit(MyCase $myCase)
    {
        abort_if(Gate::denies('my_case_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaints = Complaint::pluck('title', 'id');

        $categories = CasesCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $statuses = CaseStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $handle_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $report_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $myCase->load('complaints', 'category', 'status', 'handle_by', 'report_to', 'from_area', 'created_by');

        return view('admin.myCases.edit', compact('categories', 'complaints', 'handle_bies', 'myCase', 'report_tos', 'statuses'));
    }

    public function update(UpdateMyCaseRequest $request, MyCase $myCase)
    {
        $myCase->update($request->all());
        $myCase->complaints()->sync($request->input('complaints', []));

        if (count($myCase->image) > 0) {
            foreach ($myCase->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }

        $media = $myCase->image->pluck('file_name')->toArray();
        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $myCase->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
            }
        }

        MyCaseStatusChangedEvent::dispatch($myCase);

        return redirect()->route('admin.my-cases.index');
    }

    public function show(MyCase $myCase)
    {
        abort_if(Gate::denies('my_case_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myCase->load('complaints', 'category', 'status', 'handle_by', 'report_to', 'from_area', 'created_by');

        return view('admin.myCases.show', compact('myCase'));
    }

    public function destroy(MyCase $myCase)
    {
        abort_if(Gate::denies('my_case_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myCase->delete();

        return back();
    }

    public function massDestroy(MassDestroyMyCaseRequest $request)
    {
        MyCase::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('my_case_create') && Gate::denies('my_case_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MyCase();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
