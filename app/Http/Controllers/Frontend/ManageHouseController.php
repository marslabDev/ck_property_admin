<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyManageHouseRequest;
use App\Http\Requests\StoreManageHouseRequest;
use App\Http\Requests\UpdateManageHouseRequest;
use App\Models\ManageHouse;
use App\Models\ParkingLot;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManageHouseController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('manage_house_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manageHouses = ManageHouse::with(['parking_lot', 'created_by'])->get();

        $parking_lots = ParkingLot::get();

        $users = User::get();

        return view('frontend.manageHouses.index', compact('manageHouses', 'parking_lots', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('manage_house_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parking_lots = ParkingLot::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.manageHouses.create', compact('parking_lots'));
    }

    public function store(StoreManageHouseRequest $request)
    {
        $manageHouse = ManageHouse::create($request->all());

        return redirect()->route('frontend.manage-houses.index');
    }

    public function edit(ManageHouse $manageHouse)
    {
        abort_if(Gate::denies('manage_house_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parking_lots = ParkingLot::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $manageHouse->load('parking_lot', 'created_by');

        return view('frontend.manageHouses.edit', compact('manageHouse', 'parking_lots'));
    }

    public function update(UpdateManageHouseRequest $request, ManageHouse $manageHouse)
    {
        $manageHouse->update($request->all());

        return redirect()->route('frontend.manage-houses.index');
    }

    public function show(ManageHouse $manageHouse)
    {
        abort_if(Gate::denies('manage_house_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manageHouse->load('parking_lot', 'created_by');

        return view('frontend.manageHouses.show', compact('manageHouse'));
    }

    public function destroy(ManageHouse $manageHouse)
    {
        abort_if(Gate::denies('manage_house_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manageHouse->delete();

        return back();
    }

    public function massDestroy(MassDestroyManageHouseRequest $request)
    {
        ManageHouse::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
