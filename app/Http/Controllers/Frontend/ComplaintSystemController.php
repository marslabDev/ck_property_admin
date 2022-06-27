<?php

namespace App\Http\Controllers\Frontend;

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

class ComplaintSystemController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('complaint_system_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaintSystems = ComplaintSystem::with(['create_by', 'created_by', 'media'])->get();

        $users = User::get();

        return view('frontend.complaintSystems.index', compact('complaintSystems', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('complaint_system_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $create_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.complaintSystems.create', compact('create_bies'));
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

        return redirect()->route('frontend.complaint-systems.index');
    }

    public function edit(ComplaintSystem $complaintSystem)
    {
        abort_if(Gate::denies('complaint_system_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaintSystem->load('create_by', 'created_by');

        return view('frontend.complaintSystems.edit', compact('complaintSystem'));
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

        return redirect()->route('frontend.complaint-systems.index');
    }

    public function show(ComplaintSystem $complaintSystem)
    {
        abort_if(Gate::denies('complaint_system_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaintSystem->load('create_by', 'created_by');

        return view('frontend.complaintSystems.show', compact('complaintSystem'));
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
