<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyParkingLotRequest;
use App\Http\Requests\StoreParkingLotRequest;
use App\Http\Requests\UpdateParkingLotRequest;
use App\Models\Area;
use App\Models\ManageHouse;
use App\Models\ParkingLot;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ParkingLotController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('parking_lot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ParkingLot::with(['house', 'from_area', 'created_by'])->select(sprintf('%s.*', (new ParkingLot())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'parking_lot_show';
                $editGate = 'parking_lot_edit';
                $deleteGate = 'parking_lot_delete';
                $crudRoutePart = 'parking-lots';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('lot_no', function ($row) {
                return $row->lot_no ? $row->lot_no : '';
            });
            $table->editColumn('floor', function ($row) {
                return $row->floor ? $row->floor : '';
            });
            $table->addColumn('house_unit_no', function ($row) {
                return $row->house ? $row->house->unit_no : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'house']);

            return $table->make(true);
        }

        $manage_houses = ManageHouse::get();
        $areas         = Area::get();
        $users         = User::get();

        return view('admin.parkingLots.index', compact('manage_houses', 'areas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('parking_lot_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houses = ManageHouse::pluck('unit_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.parkingLots.create', compact('houses'));
    }

    public function store(StoreParkingLotRequest $request)
    {
        $parkingLot = ParkingLot::create($request->all());

        return redirect()->route('admin.parking-lots.index');
    }

    public function edit(ParkingLot $parkingLot)
    {
        abort_if(Gate::denies('parking_lot_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houses = ManageHouse::pluck('unit_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parkingLot->load('house', 'from_area', 'created_by');

        return view('admin.parkingLots.edit', compact('houses', 'parkingLot'));
    }

    public function update(UpdateParkingLotRequest $request, ParkingLot $parkingLot)
    {
        $parkingLot->update($request->all());

        return redirect()->route('admin.parking-lots.index');
    }

    public function show(ParkingLot $parkingLot)
    {
        abort_if(Gate::denies('parking_lot_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parkingLot->load('house', 'from_area', 'created_by', 'parkingLotManageHouses');

        return view('admin.parkingLots.show', compact('parkingLot'));
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
