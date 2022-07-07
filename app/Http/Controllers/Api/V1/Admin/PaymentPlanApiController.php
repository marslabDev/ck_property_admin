<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentPlanRequest;
use App\Http\Requests\UpdatePaymentPlanRequest;
use App\Http\Resources\Admin\PaymentPlanResource;
use App\Models\PaymentPlan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentPlanApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payment_plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaymentPlanResource(PaymentPlan::with(['user', 'house', 'payment_items', 'created_by'])->get());
    }

    public function store(StorePaymentPlanRequest $request)
    {
        $paymentPlan = PaymentPlan::create($request->all());
        $paymentPlan->payment_items()->sync($request->input('payment_items', []));

        return (new PaymentPlanResource($paymentPlan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PaymentPlan $paymentPlan)
    {
        abort_if(Gate::denies('payment_plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaymentPlanResource($paymentPlan->load(['user', 'house', 'payment_items', 'created_by']));
    }

    public function update(UpdatePaymentPlanRequest $request, PaymentPlan $paymentPlan)
    {
        $paymentPlan->update($request->all());
        $paymentPlan->payment_items()->sync($request->input('payment_items', []));

        return (new PaymentPlanResource($paymentPlan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PaymentPlan $paymentPlan)
    {
        abort_if(Gate::denies('payment_plan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentPlan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
