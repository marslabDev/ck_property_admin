<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyComplaintSystemRequest;
use App\Http\Requests\StoreComplaintSystemRequest;
use App\Http\Requests\UpdateComplaintSystemRequest;
use App\Models\ComplaintSystem;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ComplaintSystemController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('complaint_system_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ComplaintSystem::with(['create_by', 'created_by'])->select(sprintf('%s.*', (new ComplaintSystem())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'complaint_system_show';
                $editGate = 'complaint_system_edit';
                $deleteGate = 'complaint_system_delete';
                $crudRoutePart = 'complaint-systems';

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
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
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
            $table->addColumn('create_by_name', function ($row) {
                return $row->create_by ? $row->create_by->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image', 'create_by']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.complaintSystems.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('complaint_system_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $create_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.complaintSystems.create', compact('create_bies'));
    }

    public function store(StoreComplaintSystemRequest $request)
    {
        $complaintSystem = ComplaintSystem::create($request->all());

        if ($request->input('image', false)) {
            $complaintSystem->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $complaintSystem->id]);
        }

        return redirect()->route('admin.complaint-systems.index');
    }

    public function edit(ComplaintSystem $complaintSystem)
    {
        abort_if(Gate::denies('complaint_system_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaintSystem->load('create_by', 'created_by');

        return view('admin.complaintSystems.edit', compact('complaintSystem'));
    }

    public function update(UpdateComplaintSystemRequest $request, ComplaintSystem $complaintSystem)
    {
        $complaintSystem->update($request->all());

        if ($request->input('image', false)) {
            if (!$complaintSystem->image || $request->input('image') !== $complaintSystem->image->file_name) {
                if ($complaintSystem->image) {
                    $complaintSystem->image->delete();
                }
                $complaintSystem->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($complaintSystem->image) {
            $complaintSystem->image->delete();
        }

        return redirect()->route('admin.complaint-systems.index');
    }

    public function show(ComplaintSystem $complaintSystem)
    {
        abort_if(Gate::denies('complaint_system_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaintSystem->load('create_by', 'created_by');

        return view('admin.complaintSystems.show', compact('complaintSystem'));
    }

    public function destroy(ComplaintSystem $complaintSystem)
    {
        abort_if(Gate::denies('complaint_system_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaintSystem->delete();

        return back();
    }

    public function massDestroy(MassDestroyComplaintSystemRequest $request)
    {
        ComplaintSystem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('complaint_system_create') && Gate::denies('complaint_system_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ComplaintSystem();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
