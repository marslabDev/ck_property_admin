<?php

namespace App\Http\Controllers\Frontend;

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

class ManagePriceController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('manage_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managePrices = ManagePrice::with(['area', 'house_type', 'created_by'])->get();

        $areas = Area::get();

        $house_types = HouseType::get();

        $users = User::get();

        return view('frontend.managePrices.index', compact('areas', 'house_types', 'managePrices', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('manage_price_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $house_types = HouseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.managePrices.create', compact('areas', 'house_types'));
    }

    public function store(StoreManagePriceRequest $request)
    {
        $managePrice = ManagePrice::create($request->all());

        return redirect()->route('frontend.manage-prices.index');
    }

    public function edit(ManagePrice $managePrice)
    {
        abort_if(Gate::denies('manage_price_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $house_types = HouseType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $managePrice->load('area', 'house_type', 'created_by');

        return view('frontend.managePrices.edit', compact('areas', 'house_types', 'managePrice'));
    }

    public function update(UpdateManagePriceRequest $request, ManagePrice $managePrice)
    {
        $managePrice->update($request->all());

        return redirect()->route('frontend.manage-prices.index');
    }

    public function show(ManagePrice $managePrice)
    {
        abort_if(Gate::denies('manage_price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managePrice->load('area', 'house_type', 'created_by');

        return view('frontend.managePrices.show', compact('managePrice'));
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
