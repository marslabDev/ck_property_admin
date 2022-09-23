<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBillChargeRequest;
use App\Http\Requests\StoreBillChargeRequest;
use App\Http\Requests\UpdateBillChargeRequest;
use App\Models\Area;
use App\Models\BillCharge;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillChargeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bill_charge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billCharges = BillCharge::with(['from_area', 'created_by'])->get();

        $areas = Area::get();

        $users = User::get();

        return view('frontend.billCharges.index', compact('areas', 'billCharges', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bill_charge_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.billCharges.create');
    }

    public function store(StoreBillChargeRequest $request)
    {
        $billCharge = BillCharge::create($request->all());

        return redirect()->route('frontend.bill-charges.index');
    }

    public function edit(BillCharge $billCharge)
    {
        abort_if(Gate::denies('bill_charge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billCharge->load('from_area', 'created_by');

        return view('frontend.billCharges.edit', compact('billCharge'));
    }

    public function update(UpdateBillChargeRequest $request, BillCharge $billCharge)
    {
        $billCharge->update($request->all());

        return redirect()->route('frontend.bill-charges.index');
    }

    public function show(BillCharge $billCharge)
    {
        abort_if(Gate::denies('bill_charge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billCharge->load('from_area', 'created_by', 'billChargesBills');

        return view('frontend.billCharges.show', compact('billCharge'));
    }

    public function destroy(BillCharge $billCharge)
    {
        abort_if(Gate::denies('bill_charge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billCharge->delete();

        return back();
    }

    public function massDestroy(MassDestroyBillChargeRequest $request)
    {
        BillCharge::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
