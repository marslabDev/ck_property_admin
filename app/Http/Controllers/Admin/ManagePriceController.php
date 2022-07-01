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
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ManagePriceController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('manage_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ManagePrice::with(['area', 'house_type', 'created_by'])->select(sprintf('%s.*', (new ManagePrice())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'manage_price_show';
                $editGate = 'manage_price_edit';
                $deleteGate = 'manage_price_delete';
                $crudRoutePart = 'manage-prices';

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
            $table->addColumn('area_name', function ($row) {
                return $row->area ? $row->area->name : '';
            });

            $table->addColumn('house_type_name', function ($row) {
                return $row->house_type ? $row->house_type->name : '';
            });

            $table->editColumn('price_per_sq_ft', function ($row) {
                return $row->price_per_sq_ft ? $row->price_per_sq_ft : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'area', 'house_type']);

            return $table->make(true);
        }

        $areas       = Area::get();
        $house_types = HouseType::get();
        $users       = User::get();

        return view('admin.managePrices.index', compact('areas', 'house_types', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('manage_price_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $house_types = HouseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.managePrices.create', compact('areas', 'house_types'));
    }

    public function store(StoreManagePriceRequest $request)
    {
        $managePrice = ManagePrice::create($request->all());

        return redirect()->route('admin.manage-prices.index');
    }

    public function edit(ManagePrice $managePrice)
    {
        abort_if(Gate::denies('manage_price_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $house_types = HouseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $managePrice->load('area', 'house_type', 'created_by');

        return view('admin.managePrices.edit', compact('areas', 'house_types', 'managePrice'));
    }

    public function update(UpdateManagePriceRequest $request, ManagePrice $managePrice)
    {
        $managePrice->update($request->all());

        return redirect()->route('admin.manage-prices.index');
    }

    public function show(ManagePrice $managePrice)
    {
        abort_if(Gate::denies('manage_price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managePrice->load('area', 'house_type', 'created_by');

        return view('admin.managePrices.show', compact('managePrice'));
    }

    public function destroy(ManagePrice $managePrice)
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
