<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentItemRequest;
use App\Http\Requests\UpdatePaymentItemRequest;
use App\Http\Resources\Admin\PaymentItemResource;
use App\Models\PaymentItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentItemApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payment_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaymentItemResource(PaymentItem::with(['created_by'])->get());
    }

    public function store(StorePaymentItemRequest $request)
    {
        $paymentItem = PaymentItem::create($request->all());

        return (new PaymentItemResource($paymentItem))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PaymentItem $paymentItem)
    {
        abort_if(Gate::denies('payment_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaymentItemResource($paymentItem->load(['created_by']));
    }

    public function update(UpdatePaymentItemRequest $request, PaymentItem $paymentItem)
    {
        $paymentItem->update($request->all());

        return (new PaymentItemResource($paymentItem))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PaymentItem $paymentItem)
    {
        abort_if(Gate::denies('payment_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentItem->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
