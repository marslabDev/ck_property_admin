<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHouseStatusRequest;
use App\Http\Requests\StoreHouseStatusRequest;
use App\Http\Requests\UpdateHouseStatusRequest;
use App\Models\Area;
use App\Models\HouseStatus;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HouseStatusController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('house_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseStatuses = HouseStatus::with(['from_area', 'created_by'])->get();

        $areas = Area::get();

        $users = User::get();

        return view('frontend.houseStatuses.index', compact('areas', 'houseStatuses', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('house_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.houseStatuses.create');
    }

    public function store(StoreHouseStatusRequest $request)
    {
        $houseStatus = HouseStatus::create($request->all());

        return redirect()->route('frontend.house-statuses.index');
    }

    public function edit(HouseStatus $houseStatus)
    {
        abort_if(Gate::denies('house_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseStatus->load('from_area', 'created_by');

        return view('frontend.houseStatuses.edit', compact('houseStatus'));
    }

    public function update(UpdateHouseStatusRequest $request, HouseStatus $houseStatus)
    {
        $houseStatus->update($request->all());

        return redirect()->route('frontend.house-statuses.index');
    }

    public function show(HouseStatus $houseStatus)
    {
        abort_if(Gate::denies('house_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseStatus->load('from_area', 'created_by', 'houseStatusManageHouses');

        return view('frontend.houseStatuses.show', compact('houseStatus'));
    }

    public function destroy(HouseStatus $houseStatus)
    {
        abort_if(Gate::denies('house_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyHouseStatusRequest $request)
    {
        HouseStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
