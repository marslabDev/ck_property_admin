<?php

namespace App\Http\Controllers\Frontend;

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

class BillStatusController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bill_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billStatuses = BillStatus::with(['from_area', 'created_by'])->get();

        $areas = Area::get();

        $users = User::get();

        return view('frontend.billStatuses.index', compact('areas', 'billStatuses', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bill_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.billStatuses.create');
    }

    public function store(StoreBillStatusRequest $request)
    {
        $billStatus = BillStatus::create($request->all());

        return redirect()->route('frontend.bill-statuses.index');
    }

    public function edit(BillStatus $billStatus)
    {
        abort_if(Gate::denies('bill_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billStatus->load('from_area', 'created_by');

        return view('frontend.billStatuses.edit', compact('billStatus'));
    }

    public function update(UpdateBillStatusRequest $request, BillStatus $billStatus)
    {
        $billStatus->update($request->all());

        return redirect()->route('frontend.bill-statuses.index');
    }

    public function show(BillStatus $billStatus)
    {
        abort_if(Gate::denies('bill_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billStatus->load('from_area', 'created_by');

        return view('frontend.billStatuses.show', compact('billStatus'));
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
