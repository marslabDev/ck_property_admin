<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMaintananceTypeRequest;
use App\Http\Requests\StoreMaintananceTypeRequest;
use App\Http\Requests\UpdateMaintananceTypeRequest;
use App\Models\MaintananceType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintananceTypeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('maintanance_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintananceTypes = MaintananceType::all();

        return view('frontend.maintananceTypes.index', compact('maintananceTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('maintanance_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.maintananceTypes.create');
    }

    public function store(StoreMaintananceTypeRequest $request)
    {
        $maintananceType = MaintananceType::create($request->all());

        return redirect()->route('frontend.maintanance-types.index');
    }

    public function edit(MaintananceType $maintananceType)
    {
        abort_if(Gate::denies('maintanance_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.maintananceTypes.edit', compact('maintananceType'));
    }

    public function update(UpdateMaintananceTypeRequest $request, MaintananceType $maintananceType)
    {
        $maintananceType->update($request->all());

        return redirect()->route('frontend.maintanance-types.index');
    }

    public function show(MaintananceType $maintananceType)
    {
        abort_if(Gate::denies('maintanance_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.maintananceTypes.show', compact('maintananceType'));
    }

    public function destroy(MaintananceType $maintananceType)
    {
        abort_if(Gate::denies('maintanance_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintananceType->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaintananceTypeRequest $request)
    {
        MaintananceType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
