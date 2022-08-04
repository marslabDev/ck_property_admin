<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHouseTypeRequest;
use App\Http\Requests\StoreHouseTypeRequest;
use App\Http\Requests\UpdateHouseTypeRequest;
use App\Models\Area;
use App\Models\HouseType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HouseTypeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('house_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseTypes = HouseType::with(['from_area', 'created_by'])->get();

        $areas = Area::get();

        $users = User::get();

        return view('frontend.houseTypes.index', compact('areas', 'houseTypes', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('house_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.houseTypes.create');
    }

    public function store(StoreHouseTypeRequest $request)
    {
        $houseType = HouseType::create($request->all());

        return redirect()->route('frontend.house-types.index');
    }

    public function edit(HouseType $houseType)
    {
        abort_if(Gate::denies('house_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseType->load('from_area', 'created_by');

        return view('frontend.houseTypes.edit', compact('houseType'));
    }

    public function update(UpdateHouseTypeRequest $request, HouseType $houseType)
    {
        $houseType->update($request->all());

        return redirect()->route('frontend.house-types.index');
    }

    public function show(HouseType $houseType)
    {
        abort_if(Gate::denies('house_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseType->load('from_area', 'created_by', 'houseTypeManageHouses', 'houseTypeManagePrices');

        return view('frontend.houseTypes.show', compact('houseType'));
    }

    public function destroy(HouseType $houseType)
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
