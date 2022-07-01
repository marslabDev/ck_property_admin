<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHouseTypeRequest;
use App\Http\Requests\UpdateHouseTypeRequest;
use App\Http\Resources\Admin\HouseTypeResource;
use App\Models\HouseType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HouseTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('house_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HouseTypeResource(HouseType::with(['area', 'created_by'])->get());
    }

    public function store(StoreHouseTypeRequest $request)
    {
        $houseType = HouseType::create($request->all());

        return (new HouseTypeResource($houseType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(HouseType $houseType)
    {
        abort_if(Gate::denies('house_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HouseTypeResource($houseType->load(['area', 'created_by']));
    }

    public function update(UpdateHouseTypeRequest $request, HouseType $houseType)
    {
        $houseType->update($request->all());

        return (new HouseTypeResource($houseType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(HouseType $houseType)
    {
        abort_if(Gate::denies('house_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
