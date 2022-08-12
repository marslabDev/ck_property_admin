<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyParkingLotRequest;
use App\Http\Requests\StoreParkingLotRequest;
use App\Http\Requests\UpdateParkingLotRequest;
use App\Models\Area;
use App\Models\ParkingLot;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ParkingLotController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request, Area $area)
    {
        abort_if(Gate::denies('parking_lot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ParkingLot::with(['from_area', 'created_by'])
                ->select(sprintf('%s.*', (new ParkingLot())->table))
                ->where('from_area_id', $area->id);

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'parking_lot_show';
                $editGate = 'parking_lot_edit';
                $deleteGate = 'parking_lot_delete';
                $crudRoutePart = 'parking-lots';

                return view('partials.admin.datatablesActions', compact(
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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $areas = Area::get();
        $users = User::get();

        return view('admin.parkingLots.index', compact('areas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('parking_lot_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.parkingLots.create');
    }

    public function store(StoreParkingLotRequest $request, Area $area)
    {
        $parkingLot = ParkingLot::create($request->all());

        return redirect()->route('admin.parking-lots.index', compact('area'));
    }

    public function edit(Area $area, ParkingLot $parkingLot)
    {
        abort_if(Gate::denies('parking_lot_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parkingLot->load('from_area', 'created_by');

        return view('admin.parkingLots.edit', compact('parkingLot'));
    }

    public function update(UpdateParkingLotRequest $request, Area $area, ParkingLot $parkingLot)
    {
        $parkingLot->update($request->all());

        return redirect()->route('admin.parking-lots.index', compact('area'));
    }

    public function show(Area $area, ParkingLot $parkingLot)
    {
        abort_if(Gate::denies('parking_lot_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parkingLot->load('from_area', 'created_by', 'parkingLotManageHouses');

        return view('admin.parkingLots.show', compact('area', 'parkingLot'));
    }

    public function destroy(Area $area, ParkingLot $parkingLot)
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
