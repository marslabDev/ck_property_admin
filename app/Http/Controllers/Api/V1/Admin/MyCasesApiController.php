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

        return new MyCaseResource(MyCase::with(['category', 'report_by', 'handle_by', 'created_by'])->get());
    }

    public function store(StoreMyCaseRequest $request)
    {
        $myCase = MyCase::create($request->all());

        if ($request->input('image', false)) {
            $myCase->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new MyCaseResource($myCase))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MyCase $myCase)
    {
        abort_if(Gate::denies('my_case_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MyCaseResource($myCase->load(['category', 'report_by', 'handle_by', 'created_by']));
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
