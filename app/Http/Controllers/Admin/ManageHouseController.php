<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class ManageHouseController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('manage_house_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ManageHouse::with(['parking_lot', 'created_by'])->select(sprintf('%s.*', (new ManageHouse())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'manage_house_show';
                $editGate = 'manage_house_edit';
                $deleteGate = 'manage_house_delete';
                $crudRoutePart = 'manage-houses';

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
            $table->editColumn('unit_no', function ($row) {
                return $row->unit_no ? $row->unit_no : '';
            });
            $table->editColumn('contact_name', function ($row) {
                return $row->contact_name ? $row->contact_name : '';
            });
            $table->editColumn('contact_no', function ($row) {
                return $row->contact_no ? $row->contact_no : '';
            });
            $table->editColumn('house_status', function ($row) {
                return $row->house_status ? ManageHouse::HOUSE_STATUS_SELECT[$row->house_status] : '';
            });
            $table->addColumn('parking_lot_name', function ($row) {
                return $row->parking_lot ? $row->parking_lot->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'parking_lot']);

            return $table->make(true);
        }

        $parking_lots = ParkingLot::get();
        $users        = User::get();

        return view('admin.manageHouses.index', compact('parking_lots', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('manage_house_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parking_lots = ParkingLot::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.manageHouses.create', compact('parking_lots'));
    }

    public function store(StoreManageHouseRequest $request)
    {
        $manageHouse = ManageHouse::create($request->all());

        return redirect()->route('admin.manage-houses.index');
    }

    public function edit(ManageHouse $manageHouse)
    {
        abort_if(Gate::denies('manage_house_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parking_lots = ParkingLot::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $manageHouse->load('parking_lot', 'created_by');

        return view('admin.manageHouses.edit', compact('manageHouse', 'parking_lots'));
    }

    public function update(UpdateManageHouseRequest $request, ManageHouse $manageHouse)
    {
        $manageHouse->update($request->all());

        return redirect()->route('admin.manage-houses.index');
    }

    public function show(ManageHouse $manageHouse)
    {
        abort_if(Gate::denies('manage_house_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $manageHouse->load('parking_lot', 'created_by');

        return view('admin.manageHouses.show', compact('manageHouse'));
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
