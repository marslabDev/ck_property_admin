<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyManagePriceRequest;
use App\Http\Requests\StoreManagePriceRequest;
use App\Http\Requests\UpdateManagePriceRequest;
use App\Models\Area;
use App\Models\HouseType;
use App\Models\ManagePrice;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ManagePriceController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request, Area $area)
    {
        abort_if(Gate::denies('manage_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ManagePrice::with(['house_type', 'from_area', 'created_by'])
                ->select(sprintf('%s.*', (new ManagePrice())->table))
                ->where('from_area_id', $area->id)
                ->orWhere('from_area_id', 1);

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'manage_price_show';
                $editGate = 'manage_price_edit';
                $deleteGate = 'manage_price_delete';
                $crudRoutePart = 'manage-prices';

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
            $table->addColumn('house_type_name', function ($row) {
                return $row->house_type ? $row->house_type->name : '';
            });

            $table->editColumn('price_per_sq_ft', function ($row) {
                return $row->price_per_sq_ft ? $row->price_per_sq_ft : '';
            });
            $table->addColumn('from_area_name', function ($row) {
                return $row->from_area ? $row->from_area->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'house_type', 'from_area']);

            return $table->make(true);
        }

        $house_types = HouseType::get();
        $areas       = Area::get();
        $users       = User::get();

        return view('admin.managePrices.index', compact('house_types', 'areas', 'users'));
    }

    public function create(Area $area)
    {
        abort_if(Gate::denies('manage_price_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $house_types = HouseType::with('from_area')
            ->where('from_area_id', $area->id)
            ->orWhere('from_area_id', 1)
            ->pluck('name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.managePrices.create', compact('house_types'));
    }

    public function store(StoreManagePriceRequest $request, Area $area)
    {
        $managePrice = ManagePrice::create($request->all());

        return redirect()->route('admin.manage-prices.index', compact('area'));
    }

    public function edit(Area $area, ManagePrice $managePrice)
    {
        abort_if(Gate::denies('manage_price_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $house_types = HouseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $managePrice->load('house_type', 'from_area', 'created_by');

        return view('admin.managePrices.edit', compact('house_types', 'managePrice'));
    }

    public function update(UpdateManagePriceRequest $request, Area $area, ManagePrice $managePrice)
    {
        $managePrice->update($request->all());

        return redirect()->route('admin.manage-prices.index', compact('area'));
    }

    public function show(Area $area, ManagePrice $managePrice)
    {
        abort_if(Gate::denies('manage_price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managePrice->load('house_type', 'from_area', 'created_by');

        return view('admin.managePrices.show', compact('managePrice'));
    }

    public function destroy(Area $area, ManagePrice $managePrice)
    {
        abort_if(Gate::denies('manage_price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managePrice->delete();

        return back();
    }

    public function massDestroy(MassDestroyManagePriceRequest $request)
    {
        ManagePrice::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
