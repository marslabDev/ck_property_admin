<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBillStatusRequest;
use App\Http\Requests\StoreBillStatusRequest;
use App\Http\Requests\UpdateBillStatusRequest;
use App\Models\Area;
use App\Models\BillStatus;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BillStatusController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bill_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BillStatus::with(['from_area', 'created_by'])->select(sprintf('%s.*', (new BillStatus())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bill_status_show';
                $editGate = 'bill_status_edit';
                $deleteGate = 'bill_status_delete';
                $crudRoutePart = 'bill-statuses';

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
            $table->addColumn('from_area_name', function ($row) {
                return $row->from_area ? $row->from_area->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'from_area']);

            return $table->make(true);
        }

        $areas = Area::get();
        $users = User::get();

        return view('admin.billStatuses.index', compact('areas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bill_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.billStatuses.create');
    }

    public function store(StoreBillStatusRequest $request)
    {
        $billStatus = BillStatus::create($request->all());

        return redirect()->route('admin.bill-statuses.index');
    }

    public function edit(BillStatus $billStatus)
    {
        abort_if(Gate::denies('bill_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billStatus->load('from_area', 'created_by');

        return view('admin.billStatuses.edit', compact('billStatus'));
    }

    public function update(UpdateBillStatusRequest $request, BillStatus $billStatus)
    {
        $billStatus->update($request->all());

        return redirect()->route('admin.bill-statuses.index');
    }

    public function show(BillStatus $billStatus)
    {
        abort_if(Gate::denies('bill_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billStatus->load('from_area', 'created_by', 'billStatusBills');

        return view('admin.billStatuses.show', compact('billStatus'));
    }

    public function destroy(BillStatus $billStatus)
    {
        abort_if(Gate::denies('bill_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyBillStatusRequest $request)
    {
        BillStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
