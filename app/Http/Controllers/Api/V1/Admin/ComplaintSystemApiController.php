<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreComplaintSystemRequest;
use App\Http\Requests\UpdateComplaintSystemRequest;
use App\Http\Resources\Admin\ComplaintSystemResource;
use App\Models\ComplaintSystem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComplaintSystemApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('complaint_system_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ComplaintSystemResource(ComplaintSystem::with(['create_by'])->get());
    }

    public function store(StoreComplaintSystemRequest $request)
    {
        $complaintSystem = ComplaintSystem::create($request->all());

        if ($request->input('image', false)) {
            $complaintSystem->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new ComplaintSystemResource($complaintSystem))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ComplaintSystem $complaintSystem)
    {
        abort_if(Gate::denies('complaint_system_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ComplaintSystemResource($complaintSystem->load(['create_by']));
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

        return (new ComplaintSystemResource($complaintSystem))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ComplaintSystem $complaintSystem)
    {
        abort_if(Gate::denies('complaint_system_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaintSystem->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
