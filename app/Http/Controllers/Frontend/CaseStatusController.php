<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCaseStatusRequest;
use App\Http\Requests\StoreCaseStatusRequest;
use App\Http\Requests\UpdateCaseStatusRequest;
use App\Models\CaseStatus;
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

        $caseStatuses = CaseStatus::with(['created_by'])->get();

        $users = User::get();

        return view('frontend.caseStatuses.index', compact('caseStatuses', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('case_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.caseStatuses.create');
    }

    public function store(StoreCaseStatusRequest $request)
    {
        $caseStatus = CaseStatus::create($request->all());

        return redirect()->route('frontend.case-statuses.index');
    }

    public function edit(CaseStatus $caseStatus)
    {
        abort_if(Gate::denies('case_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $caseStatus->load('created_by');

        return view('frontend.caseStatuses.edit', compact('caseStatus'));
    }

    public function update(UpdateCaseStatusRequest $request, CaseStatus $caseStatus)
    {
        $caseStatus->update($request->all());

        return redirect()->route('frontend.case-statuses.index');
    }

    public function show(CaseStatus $caseStatus)
    {
        abort_if(Gate::denies('case_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $caseStatus->load('created_by');

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
