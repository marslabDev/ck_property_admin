<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHouseStatusRequest;
use App\Http\Requests\UpdateHouseStatusRequest;
use App\Http\Resources\Admin\HouseStatusResource;
use App\Models\HouseStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HouseStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('house_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HouseStatusResource(HouseStatus::with(['created_by'])->get());
    }

    public function store(StoreHouseStatusRequest $request)
    {
        $houseStatus = HouseStatus::create($request->all());

        return (new HouseStatusResource($houseStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(HouseStatus $houseStatus)
    {
        abort_if(Gate::denies('house_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HouseStatusResource($houseStatus->load(['created_by']));
    }

    public function update(UpdateHouseStatusRequest $request, HouseStatus $houseStatus)
    {
        $houseStatus->update($request->all());

        return (new HouseStatusResource($houseStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(HouseStatus $houseStatus)
    {
        abort_if(Gate::denies('house_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
