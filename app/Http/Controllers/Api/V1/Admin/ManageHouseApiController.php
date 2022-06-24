<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreManageHouseRequest;
use App\Http\Requests\UpdateManageHouseRequest;
use App\Http\Resources\Admin\ManageHouseResource;
use App\Models\ManageHouse;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManageHouseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('manage_house_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ManageHouseResource(ManageHouse::with(['parking_lot'])->get());
    }

    public function store(StoreManageHouseRequest $request)
    {
        $manageHouse = ManageHouse::create($request->all());

        return (new ManageHouseResource($manageHouse))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ManageHouse $manageHouse)
    {
        abort_if(Gate::denies('manage_house_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ManageHouseResource($manageHouse->load(['parking_lot']));
    }

    public function update(UpdateManageHouseRequest $request, ManageHouse $manageHouse)
    {
        $manageHouse->update($request->all());

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
