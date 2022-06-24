<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMaintananceRequest;
use App\Http\Requests\StoreMaintananceRequest;
use App\Http\Requests\UpdateMaintananceRequest;
use App\Models\Area;
use App\Models\Maintanance;
use App\Models\MaintananceType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintananceController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('maintanance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintanances = Maintanance::with(['type', 'area', 'handle_by', 'supplier'])->get();

        return view('frontend.maintanances.index', compact('maintanances'));
    }

    public function create()
    {
        abort_if(Gate::denies('maintanance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = MaintananceType::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $handle_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suppliers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.maintanances.create', compact('areas', 'handle_bies', 'suppliers', 'types'));
    }

    public function store(StoreMaintananceRequest $request)
    {
        $maintanance = Maintanance::create($request->all());

        return redirect()->route('frontend.maintanances.index');
    }

    public function edit(Maintanance $maintanance)
    {
        abort_if(Gate::denies('maintanance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = MaintananceType::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $handle_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suppliers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $maintanance->load('type', 'area', 'handle_by', 'supplier');

        return view('frontend.maintanances.edit', compact('areas', 'handle_bies', 'maintanance', 'suppliers', 'types'));
    }

    public function update(UpdateMaintananceRequest $request, Maintanance $maintanance)
    {
        $maintanance->update($request->all());

        return redirect()->route('frontend.maintanances.index');
    }

    public function show(Maintanance $maintanance)
    {
        abort_if(Gate::denies('maintanance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintanance->load('type', 'area', 'handle_by', 'supplier');

        return view('frontend.maintanances.show', compact('maintanance'));
    }

    public function destroy(Maintanance $maintanance)
    {
        abort_if(Gate::denies('maintanance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintanance->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaintananceRequest $request)
    {
        Maintanance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
