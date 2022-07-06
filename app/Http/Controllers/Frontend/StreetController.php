<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStreetRequest;
use App\Http\Requests\StoreStreetRequest;
use App\Http\Requests\UpdateStreetRequest;
use App\Models\Area;
use App\Models\Street;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StreetController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('street_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $streets = Street::with(['area', 'created_by'])->get();

        $areas = Area::get();

        $users = User::get();

        return view('frontend.streets.index', compact('areas', 'streets', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('street_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.streets.create', compact('areas'));
    }

    public function store(StoreStreetRequest $request)
    {
        $street = Street::create($request->all());

        return redirect()->route('frontend.streets.index');
    }

    public function edit(Street $street)
    {
        abort_if(Gate::denies('street_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $street->load('area', 'created_by');

        return view('frontend.streets.edit', compact('areas', 'street'));
    }

    public function update(UpdateStreetRequest $request, Street $street)
    {
        $street->update($request->all());

        return redirect()->route('frontend.streets.index');
    }

    public function show(Street $street)
    {
        abort_if(Gate::denies('street_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $street->load('area', 'created_by');

        return view('frontend.streets.show', compact('street'));
    }

    public function destroy(Street $street)
    {
        abort_if(Gate::denies('street_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $street->delete();

        return back();
    }

    public function massDestroy(MassDestroyStreetRequest $request)
    {
        Street::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
