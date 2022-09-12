<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBillItemRequest;
use App\Http\Requests\StoreBillItemRequest;
use App\Http\Requests\UpdateBillItemRequest;
use App\Models\Area;
use App\Models\BillItem;
use App\Models\BillParticular;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillItemController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bill_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billItems = BillItem::with(['bill_particular', 'from_area', 'created_by'])->get();

        $bill_particulars = BillParticular::get();

        $areas = Area::get();

        $users = User::get();

        return view('frontend.billItems.index', compact('areas', 'billItems', 'bill_particulars', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bill_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill_particulars = BillParticular::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.billItems.create', compact('bill_particulars'));
    }

    public function store(StoreBillItemRequest $request)
    {
        $billItem = BillItem::create($request->all());

        return redirect()->route('frontend.bill-items.index');
    }

    public function edit(BillItem $billItem)
    {
        abort_if(Gate::denies('bill_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill_particulars = BillParticular::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $billItem->load('bill_particular', 'from_area', 'created_by');

        return view('frontend.billItems.edit', compact('billItem', 'bill_particulars'));
    }

    public function update(UpdateBillItemRequest $request, BillItem $billItem)
    {
        $billItem->update($request->all());

        return redirect()->route('frontend.bill-items.index');
    }

    public function show(BillItem $billItem)
    {
        abort_if(Gate::denies('bill_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billItem->load('bill_particular', 'from_area', 'created_by', 'billItemBills');

        return view('frontend.billItems.show', compact('billItem'));
    }

    public function destroy(BillItem $billItem)
    {
        abort_if(Gate::denies('bill_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyBillItemRequest $request)
    {
        BillItem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
