<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCaseStatusRequest;
use App\Http\Requests\StoreCaseStatusRequest;
use App\Http\Requests\UpdateCaseStatusRequest;
use App\Models\CaseStatus;
use App\Models\ComplaintStatus;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CaseStatusController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('case_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $caseStatuses = CaseStatus::with(['complaint_status', 'created_by'])->get();

        $complaint_statuses = ComplaintStatus::get();

        $users = User::get();

        return view('frontend.caseStatuses.index', compact('caseStatuses', 'complaint_statuses', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('case_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaint_statuses = ComplaintStatus::pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.caseStatuses.create', compact('complaint_statuses'));
    }

    public function store(StoreCaseStatusRequest $request)
    {
        $caseStatus = CaseStatus::create($request->all());

        return redirect()->route('frontend.case-statuses.index');
    }

    public function edit(CaseStatus $caseStatus)
    {
        abort_if(Gate::denies('case_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaint_statuses = ComplaintStatus::pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $caseStatus->load('complaint_status', 'created_by');

        return view('frontend.caseStatuses.edit', compact('caseStatus', 'complaint_statuses'));
    }

    public function update(UpdateCaseStatusRequest $request, CaseStatus $caseStatus)
    {
        $caseStatus->update($request->all());

        return redirect()->route('frontend.case-statuses.index');
    }

    public function show(CaseStatus $caseStatus)
    {
        abort_if(Gate::denies('case_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $caseStatus->load('complaint_status', 'created_by', 'statusMyCases');

        return view('frontend.caseStatuses.show', compact('caseStatus'));
    }

    public function destroy(CaseStatus $caseStatus)
    {
        abort_if(Gate::denies('case_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $caseStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyCaseStatusRequest $request)
    {
        CaseStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
