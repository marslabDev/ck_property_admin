<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMyCaseRequest;
use App\Http\Requests\StoreMyCaseRequest;
use App\Http\Requests\UpdateMyCaseRequest;
use App\Models\CasesCategory;
use App\Models\MyCase;
use App\Models\User;
use Gate;
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
            $query = MyCase::with(['category', 'report_by', 'handle_by', 'created_by'])->select(sprintf('%s.*', (new MyCase())->table));
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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->addColumn('category_title', function ($row) {
                return $row->category ? $row->category->title : '';
            });

            $table->editColumn('urgent_status', function ($row) {
                return $row->urgent_status ? $row->urgent_status : '';
            });
            $table->editColumn('progress', function ($row) {
                return $row->progress ? $row->progress : '';
            });

            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->addColumn('report_by_name', function ($row) {
                return $row->report_by ? $row->report_by->name : '';
            });

            $table->addColumn('handle_by_name', function ($row) {
                return $row->handle_by ? $row->handle_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'category', 'image', 'report_by', 'handle_by']);

            return $table->make(true);
        }

        $cases_categories = CasesCategory::get();
        $users            = User::get();

        return view('admin.myCases.index', compact('cases_categories', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('my_case_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = CasesCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $report_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $handle_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.myCases.create', compact('categories', 'handle_bies', 'report_bies'));
    }

    public function store(StoreMyCaseRequest $request)
    {
        $myCase = MyCase::create($request->all());

        if ($request->input('image', false)) {
            $myCase->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $myCase->id]);
        }

        return redirect()->route('admin.my-cases.index');
    }

    public function edit(MyCase $myCase)
    {
        abort_if(Gate::denies('my_case_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = CasesCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $report_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $handle_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $myCase->load('category', 'report_by', 'handle_by', 'created_by');

        return view('admin.myCases.edit', compact('categories', 'handle_bies', 'myCase', 'report_bies'));
    }

    public function update(UpdateMyCaseRequest $request, MyCase $myCase)
    {
        $myCase->update($request->all());

        if ($request->input('image', false)) {
            if (!$myCase->image || $request->input('image') !== $myCase->image->file_name) {
                if ($myCase->image) {
                    $myCase->image->delete();
                }
                $myCase->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($myCase->image) {
            $myCase->image->delete();
        }

        return redirect()->route('admin.my-cases.index');
    }

    public function show(MyCase $myCase)
    {
        abort_if(Gate::denies('my_case_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myCase->load('category', 'report_by', 'handle_by', 'created_by');

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
