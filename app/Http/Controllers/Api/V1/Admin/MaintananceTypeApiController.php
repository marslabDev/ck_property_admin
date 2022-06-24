<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaintananceTypeRequest;
use App\Http\Requests\UpdateMaintananceTypeRequest;
use App\Http\Resources\Admin\MaintananceTypeResource;
use App\Models\MaintananceType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaintananceTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('maintanance_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaintananceTypeResource(MaintananceType::all());
    }

    public function store(StoreMaintananceTypeRequest $request)
    {
        $maintananceType = MaintananceType::create($request->all());

        return (new MaintananceTypeResource($maintananceType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MaintananceType $maintananceType)
    {
        abort_if(Gate::denies('maintanance_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MaintananceTypeResource($maintananceType);
    }

    public function update(UpdateMaintananceTypeRequest $request, MaintananceType $maintananceType)
    {
        $maintananceType->update($request->all());

        return (new MaintananceTypeResource($maintananceType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MaintananceType $maintananceType)
    {
        abort_if(Gate::denies('maintanance_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintananceType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
