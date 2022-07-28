<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class CaseStatusController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('case_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CaseStatus::with(['created_by'])->select(sprintf('%s.*', (new CaseStatus())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'case_status_show';
                $editGate = 'case_status_edit';
                $deleteGate = 'case_status_delete';
                $crudRoutePart = 'case-statuses';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.caseStatuses.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('case_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.caseStatuses.create');
    }

    public function store(StoreCaseStatusRequest $request)
    {
        $caseStatus = CaseStatus::create($request->all());

        return redirect()->route('admin.case-statuses.index');
    }

    public function edit(CaseStatus $caseStatus)
    {
        abort_if(Gate::denies('case_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $caseStatus->load('created_by');

        return view('admin.caseStatuses.edit', compact('caseStatus'));
    }

    public function update(UpdateCaseStatusRequest $request, CaseStatus $caseStatus)
    {
        $caseStatus->update($request->all());

        return redirect()->route('admin.case-statuses.index');
    }

    public function show(CaseStatus $caseStatus)
    {
        abort_if(Gate::denies('case_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $caseStatus->load('created_by', 'statusMyCases');

        return view('admin.caseStatuses.show', compact('caseStatus'));
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
