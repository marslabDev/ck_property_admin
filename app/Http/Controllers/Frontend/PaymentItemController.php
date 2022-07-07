<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPaymentItemRequest;
use App\Http\Requests\StorePaymentItemRequest;
use App\Http\Requests\UpdatePaymentItemRequest;
use App\Models\PaymentItem;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentItemController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('payment_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentItems = PaymentItem::with(['created_by'])->get();

        $users = User::get();

        return view('frontend.paymentItems.index', compact('paymentItems', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.paymentItems.create');
    }

    public function store(StorePaymentItemRequest $request)
    {
        $paymentItem = PaymentItem::create($request->all());

        return redirect()->route('frontend.payment-items.index');
    }

    public function edit(PaymentItem $paymentItem)
    {
        abort_if(Gate::denies('payment_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentItem->load('created_by');

        return view('frontend.paymentItems.edit', compact('paymentItem'));
    }

    public function update(UpdatePaymentItemRequest $request, PaymentItem $paymentItem)
    {
        $paymentItem->update($request->all());

        return redirect()->route('frontend.payment-items.index');
    }

    public function show(PaymentItem $paymentItem)
    {
        abort_if(Gate::denies('payment_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentItem->load('created_by', 'paymentItemPaymentPlans');

        return view('frontend.paymentItems.show', compact('paymentItem'));
    }

    public function destroy(PaymentItem $paymentItem)
    {
        abort_if(Gate::denies('payment_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaymentItemRequest $request)
    {
        PaymentItem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
