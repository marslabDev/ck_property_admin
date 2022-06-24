<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyParkingLotRequest;
use App\Http\Requests\StoreParkingLotRequest;
use App\Http\Requests\UpdateParkingLotRequest;
use App\Models\ParkingLot;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParkingLotController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('parking_lot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parkingLots = ParkingLot::all();

        return view('frontend.parkingLots.index', compact('parkingLots'));
    }

    public function create()
    {
        abort_if(Gate::denies('parking_lot_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.parkingLots.create');
    }

    public function store(StoreParkingLotRequest $request)
    {
        $parkingLot = ParkingLot::create($request->all());

        return redirect()->route('frontend.parking-lots.index');
    }

    public function edit(ParkingLot $parkingLot)
    {
        abort_if(Gate::denies('parking_lot_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.parkingLots.edit', compact('parkingLot'));
    }

    public function update(UpdateParkingLotRequest $request, ParkingLot $parkingLot)
    {
        $parkingLot->update($request->all());

        return redirect()->route('frontend.parking-lots.index');
    }

    public function show(ParkingLot $parkingLot)
    {
        abort_if(Gate::denies('parking_lot_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.parkingLots.show', compact('parkingLot'));
    }

    public function destroy(ParkingLot $parkingLot)
    {
        abort_if(Gate::denies('parking_lot_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parkingLot->delete();

        return back();
    }

    public function massDestroy(MassDestroyParkingLotRequest $request)
    {
        ParkingLot::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
