<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Http\Resources\Admin\NoticeResource;
use App\Models\Notice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoticesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('notice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NoticeResource(Notice::with(['create_by', 'people_in_role', 'people_in_area', 'created_by'])->get());
    }

    public function store(StoreNoticeRequest $request)
    {
        $notice = Notice::create($request->all());

        if ($request->input('image', false)) {
            $notice->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new NoticeResource($notice))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Notice $notice)
    {
        abort_if(Gate::denies('notice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NoticeResource($notice->load(['create_by', 'people_in_role', 'people_in_area', 'created_by']));
    }

    public function update(UpdateNoticeRequest $request, Notice $notice)
    {
        $notice->update($request->all());

        if ($request->input('image', false)) {
            if (!$notice->image || $request->input('image') !== $notice->image->file_name) {
                if ($notice->image) {
                    $notice->image->delete();
                }
                $notice->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($notice->image) {
            $notice->image->delete();
        }

        return (new NoticeResource($notice))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Notice $notice)
    {
        abort_if(Gate::denies('notice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notice->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
