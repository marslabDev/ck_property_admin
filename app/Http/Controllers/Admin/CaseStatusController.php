<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCaseStatusRequest;
use App\Http\Requests\StoreCaseStatusRequest;
use App\Http\Requests\UpdateCaseStatusRequest;
use App\Models\Area;
use App\Models\CaseStatus;
use App\Models\ComplaintStatus;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
            $query = CaseStatus::with(['complaint_status', 'from_area', 'created_by'])->select(sprintf('%s.*', (new CaseStatus())->table));
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
            $table->editColumn('status_linking', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->status_linking ? 'checked' : null) . '>';
            });
            $table->addColumn('complaint_status_status', function ($row) {
                return $row->complaint_status ? $row->complaint_status->status : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'status_linking', 'complaint_status']);

            return $table->make(true);
        }

        $complaint_statuses = ComplaintStatus::get();
        $areas              = Area::get();
        $users              = User::get();

        return view('admin.caseStatuses.index', compact('complaint_statuses', 'areas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('case_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaint_statuses = ComplaintStatus::pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.caseStatuses.create', compact('complaint_statuses'));
    }

    public function store(StoreCaseStatusRequest $request)
    {
        $caseStatus = CaseStatus::create($request->all());

        return redirect()->route('admin.case-statuses.index');
    }

    public function edit(CaseStatus $caseStatus)
    {
        abort_if(Gate::denies('case_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaint_statuses = ComplaintStatus::pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $caseStatus->load('complaint_status', 'from_area', 'created_by');

        return view('admin.caseStatuses.edit', compact('caseStatus', 'complaint_statuses'));
    }

    public function update(UpdateCaseStatusRequest $request, CaseStatus $caseStatus)
    {
        $validated = $request->validated();

        if ($validated['status_linking'] == '1') {
            $caseStatus->update($request->all());
        } else {
            $caseStatus->name = $validated['name'];
            $caseStatus->status_linking = $validated['status_linking'];
            $caseStatus->complaint_status_id = null;
            $caseStatus->save();
        }

        return redirect()->route('admin.case-statuses.index');
    }

    public function show(CaseStatus $caseStatus)
    {
        abort_if(Gate::denies('case_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $caseStatus->load('complaint_status', 'from_area', 'created_by', 'statusMyCases');

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
