<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMyCaseRequest;
use App\Http\Requests\UpdateMyCaseRequest;
use App\Http\Resources\Admin\MyCaseResource;
use App\Models\MyCase;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyCasesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('my_case_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MyCaseResource(MyCase::with(['complaints', 'category', 'status', 'handle_by', 'report_to', 'created_by'])->get());
    }

    public function store(StoreMyCaseRequest $request)
    {
        $myCase = MyCase::create($request->all());
        $myCase->complaints()->sync($request->input('complaints', []));
        foreach ($request->input('image', []) as $file) {
            $myCase->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        return (new MyCaseResource($myCase))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MyCase $myCase)
    {
        abort_if(Gate::denies('my_case_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MyCaseResource($myCase->load(['complaints', 'category', 'status', 'handle_by', 'report_to', 'created_by']));
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

        return (new MyCaseResource($myCase))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MyCase $myCase)
    {
        abort_if(Gate::denies('my_case_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myCase->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
