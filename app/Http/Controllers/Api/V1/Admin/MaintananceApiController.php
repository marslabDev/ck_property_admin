<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaintananceRequest;
use App\Http\Requests\UpdateMaintananceRequest;
use App\Http\Resources\Admin\MaintananceResource;
use App\Models\Maintanance;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintananceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('maintanance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaintananceResource(Maintanance::with(['type', 'area', 'handle_by', 'supplier', 'created_by'])->get());
    }

    public function store(StoreMaintananceRequest $request)
    {
        $maintanance = Maintanance::create($request->all());

        return (new MaintananceResource($maintanance))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Maintanance $maintanance)
    {
        abort_if(Gate::denies('maintanance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaintananceResource($maintanance->load(['type', 'area', 'handle_by', 'supplier', 'created_by']));
    }

    public function update(UpdateMaintananceRequest $request, Maintanance $maintanance)
    {
        $maintanance->update($request->all());

        return (new MaintananceResource($maintanance))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Maintanance $maintanance)
    {
        abort_if(Gate::denies('maintanance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintanance->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
