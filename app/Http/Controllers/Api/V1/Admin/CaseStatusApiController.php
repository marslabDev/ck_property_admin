<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCaseStatusRequest;
use App\Http\Requests\UpdateCaseStatusRequest;
use App\Http\Resources\Admin\CaseStatusResource;
use App\Models\CaseStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CaseStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('case_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CaseStatusResource(CaseStatus::with(['created_by'])->get());
    }

    public function store(StoreCaseStatusRequest $request)
    {
        $caseStatus = CaseStatus::create($request->all());

        return (new CaseStatusResource($caseStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CaseStatus $caseStatus)
    {
        abort_if(Gate::denies('case_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CaseStatusResource($caseStatus->load(['created_by']));
    }

    public function update(UpdateCaseStatusRequest $request, CaseStatus $caseStatus)
    {
        $caseStatus->update($request->all());

        return (new CaseStatusResource($caseStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CaseStatus $caseStatus)
    {
        abort_if(Gate::denies('case_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $caseStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
