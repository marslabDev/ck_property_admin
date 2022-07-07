<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPaymentPlanRequest;
use App\Http\Requests\StorePaymentPlanRequest;
use App\Http\Requests\UpdatePaymentPlanRequest;
use App\Models\ManageHouse;
use App\Models\PaymentItem;
use App\Models\PaymentPlan;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentPlanController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('payment_plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentPlans = PaymentPlan::with(['user', 'house', 'payment_items', 'created_by'])->get();

        $users = User::get();

        $manage_houses = ManageHouse::get();

        $payment_items = PaymentItem::get();

        return view('frontend.paymentPlans.index', compact('manage_houses', 'paymentPlans', 'payment_items', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_plan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $houses = ManageHouse::pluck('unit_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_items = PaymentItem::pluck('particular', 'id');

        return view('frontend.paymentPlans.create', compact('houses', 'payment_items', 'users'));
    }

    public function store(StorePaymentPlanRequest $request)
    {
        $paymentPlan = PaymentPlan::create($request->all());
        $paymentPlan->payment_items()->sync($request->input('payment_items', []));

        return redirect()->route('frontend.payment-plans.index');
    }

    public function edit(PaymentPlan $paymentPlan)
    {
        abort_if(Gate::denies('payment_plan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $houses = ManageHouse::pluck('unit_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_items = PaymentItem::pluck('particular', 'id');

        $paymentPlan->load('user', 'house', 'payment_items', 'created_by');

        return view('frontend.paymentPlans.edit', compact('houses', 'paymentPlan', 'payment_items', 'users'));
    }

    public function update(UpdatePaymentPlanRequest $request, PaymentPlan $paymentPlan)
    {
        $paymentPlan->update($request->all());
        $paymentPlan->payment_items()->sync($request->input('payment_items', []));

        return redirect()->route('frontend.payment-plans.index');
    }

    public function show(PaymentPlan $paymentPlan)
    {
        abort_if(Gate::denies('payment_plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentPlan->load('user', 'house', 'payment_items', 'created_by', 'paymentPlanHomeOwnerTransactions');

        return view('frontend.paymentPlans.show', compact('paymentPlan'));
    }

    public function destroy(PaymentPlan $paymentPlan)
    {
        abort_if(Gate::denies('payment_plan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentPlan->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaymentPlanRequest $request)
    {
        PaymentPlan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
