<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBillRequest;
use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Area;
use App\Models\Bill;
use App\Models\BillCharge;
use App\Models\BillItem;
use App\Models\BillStatus;
use App\Models\BillType;
use App\Models\ManageHouse;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bills = Bill::with(['bill_type', 'house', 'homeowner', 'bill_items', 'bill_charges', 'bill_status', 'from_area', 'created_by'])->get();

        $bill_types = BillType::get();

        $manage_houses = ManageHouse::get();

        $users = User::get();

        $bill_items = BillItem::get();

        $bill_charges = BillCharge::get();

        $bill_statuses = BillStatus::get();

        $areas = Area::get();

        return view('frontend.bills.index', compact('areas', 'bill_charges', 'bill_items', 'bill_statuses', 'bill_types', 'bills', 'manage_houses', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bill_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill_types = BillType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $houses = ManageHouse::pluck('unit_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $homeowners = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bill_items = BillItem::pluck('total_unit', 'id');

        $bill_charges = BillCharge::pluck('name', 'id');

        $bill_statuses = BillStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.bills.create', compact('bill_charges', 'bill_items', 'bill_statuses', 'bill_types', 'homeowners', 'houses'));
    }

    public function store(StoreBillRequest $request)
    {
        $bill = Bill::create($request->all());
        $bill->bill_items()->sync($request->input('bill_items', []));
        $bill->bill_charges()->sync($request->input('bill_charges', []));

        return redirect()->route('frontend.bills.index');
    }

    public function edit(Bill $bill)
    {
        abort_if(Gate::denies('bill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill_types = BillType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $houses = ManageHouse::pluck('unit_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $homeowners = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bill_items = BillItem::pluck('total_unit', 'id');

        $bill_charges = BillCharge::pluck('name', 'id');

        $bill_statuses = BillStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bill->load('bill_type', 'house', 'homeowner', 'bill_items', 'bill_charges', 'bill_status', 'from_area', 'created_by');

        return view('frontend.bills.edit', compact('bill', 'bill_charges', 'bill_items', 'bill_statuses', 'bill_types', 'homeowners', 'houses'));
    }

    public function update(UpdateBillRequest $request, Bill $bill)
    {
        $bill->update($request->all());
        $bill->bill_items()->sync($request->input('bill_items', []));
        $bill->bill_charges()->sync($request->input('bill_charges', []));

        return redirect()->route('frontend.bills.index');
    }

    public function show(Bill $bill)
    {
        abort_if(Gate::denies('bill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill->load('bill_type', 'house', 'homeowner', 'bill_items', 'bill_charges', 'bill_status', 'from_area', 'created_by', 'billBillHistories', 'billBillItems');

        return view('frontend.bills.show', compact('bill'));
    }

    public function destroy(Bill $bill)
    {
        abort_if(Gate::denies('bill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill->delete();

        return back();
    }

    public function massDestroy(MassDestroyBillRequest $request)
    {
        Bill::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
