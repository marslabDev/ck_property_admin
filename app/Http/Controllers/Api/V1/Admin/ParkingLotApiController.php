<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParkingLotRequest;
use App\Http\Requests\UpdateParkingLotRequest;
use App\Http\Resources\Admin\ParkingLotResource;
use App\Models\ParkingLot;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParkingLotApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('parking_lot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ParkingLotResource(ParkingLot::with(['created_by'])->get());
    }

    public function store(StoreParkingLotRequest $request)
    {
        $parkingLot = ParkingLot::create($request->all());

        return (new ParkingLotResource($parkingLot))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ParkingLot $parkingLot)
    {
        abort_if(Gate::denies('parking_lot_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ParkingLotResource($parkingLot->load(['created_by']));
    }

    public function update(UpdateParkingLotRequest $request, ParkingLot $parkingLot)
    {
        $parkingLot->update($request->all());

        return (new ParkingLotResource($parkingLot))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ParkingLot $parkingLot)
    {
        abort_if(Gate::denies('parking_lot_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parkingLot->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
