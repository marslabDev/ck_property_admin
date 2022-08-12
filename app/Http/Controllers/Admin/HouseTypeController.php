<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHouseTypeRequest;
use App\Http\Requests\StoreHouseTypeRequest;
use App\Http\Requests\UpdateHouseTypeRequest;
use App\Models\Area;
use App\Models\HouseType;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HouseTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request, Area $area)
    {
        abort_if(Gate::denies('house_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HouseType::with(['from_area', 'created_by'])
                ->select(sprintf('%s.*', (new HouseType())->table))
                ->where('from_area_id', $area->id);

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'house_type_show';
                $editGate = 'house_type_edit';
                $deleteGate = 'house_type_delete';
                $crudRoutePart = 'house-types';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? HouseType::TYPE_SELECT[$row->type] : '';
            });
            $table->addColumn('from_area_name', function ($row) {
                return $row->from_area ? $row->from_area->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'from_area']);

            return $table->make(true);
        }

        $areas = Area::get();
        $users = User::get();

        return view('admin.houseTypes.index', compact('areas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('house_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.houseTypes.create');
    }

    public function store(StoreHouseTypeRequest $request, Area $area)
    {
        $houseType = HouseType::create($request->all());

        return redirect()->route('admin.house-types.index', compact('area'));
    }

    public function edit(Area $area, HouseType $houseType)
    {
        abort_if(Gate::denies('house_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseType->load('from_area', 'created_by');

        return view('admin.houseTypes.edit', compact('area', 'houseType'));
    }

    public function update(UpdateHouseTypeRequest $request, Area $area, HouseType $houseType)
    {
        $houseType->update($request->all());

        return redirect()->route('admin.house-types.index', compact('area'));
    }

    public function show(Area $area, HouseType $houseType)
    {
        abort_if(Gate::denies('house_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseType->load('from_area', 'created_by', 'houseTypeManageHouses', 'houseTypeManagePrices');

        return view('admin.houseTypes.show', compact('area', 'houseType'));
    }

    public function destroy(Area $area, HouseType $houseType)
    {
        abort_if(Gate::denies('house_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseType->delete();

        return back();
    }

    public function massDestroy(MassDestroyHouseTypeRequest $request)
    {
        HouseType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
