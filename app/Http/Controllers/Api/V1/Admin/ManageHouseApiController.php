<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreManageHouseRequest;
use App\Http\Requests\UpdateManageHouseRequest;
use App\Http\Resources\Admin\ManageHouseResource;
use App\Models\ManageHouse;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManageHouseApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('manage_house_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ManageHouseResource(ManageHouse::with(['house_type', 'parking_lot', 'owned_bies', 'created_by'])->get());
    }

    public function store(StoreManageHouseRequest $request)
    {
        $manageHouse = ManageHouse::create($request->all());
        $manageHouse->owned_bies()->sync($request->input('owned_bies', []));
        foreach ($request->input('documents', []) as $file) {
            $manageHouse->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('documents');
        }

        return (new ManageHouseResource($manageHouse))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ManageHouse $manageHouse)
    {
        abort_if(Gate::denies('manage_house_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ManageHouseResource($manageHouse->load(['house_type', 'parking_lot', 'owned_bies', 'created_by']));
    }

    public function update(UpdateManageHouseRequest $request, ManageHouse $manageHouse)
    {
        $manageHouse->update($request->all());
        $manageHouse->owned_bies()->sync($request->input('owned_bies', []));
        if (count($manageHouse->documents) > 0) {
            foreach ($manageHouse->documents as $media) {
                if (!in_array($media->file_name, $request->input('documents', []))) {
                    $media->delete();
                }
            }
        }
        $media = $manageHouse->documents->pluck('file_name')->toArray();
        foreach ($request->input('documents', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $manageHouse->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('documents');
            }
        }

        return (new ManageHouseResource($manageHouse))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ManageHouse $manageHouse)
    {
        abort_if(Gate::denies('manage_house_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manageHouse->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
