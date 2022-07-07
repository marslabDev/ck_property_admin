<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPaymentChargeRequest;
use App\Http\Requests\StorePaymentChargeRequest;
use App\Http\Requests\UpdatePaymentChargeRequest;
use App\Models\PaymentCharge;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentChargeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('payment_charge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentCharges = PaymentCharge::with(['created_by'])->get();

        $users = User::get();

        return view('frontend.paymentCharges.index', compact('paymentCharges', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_charge_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.paymentCharges.create');
    }

    public function store(StorePaymentChargeRequest $request)
    {
        $paymentCharge = PaymentCharge::create($request->all());

        return redirect()->route('frontend.payment-charges.index');
    }

    public function edit(PaymentCharge $paymentCharge)
    {
        abort_if(Gate::denies('payment_charge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentCharge->load('created_by');

        return view('frontend.paymentCharges.edit', compact('paymentCharge'));
    }

    public function update(UpdatePaymentChargeRequest $request, PaymentCharge $paymentCharge)
    {
        $paymentCharge->update($request->all());

        return redirect()->route('frontend.payment-charges.index');
    }

    public function show(PaymentCharge $paymentCharge)
    {
        abort_if(Gate::denies('payment_charge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentCharge->load('created_by');

        return view('frontend.paymentCharges.show', compact('paymentCharge'));
    }

    public function destroy(PaymentCharge $paymentCharge)
    {
        abort_if(Gate::denies('payment_charge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentCharge->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaymentChargeRequest $request)
    {
        PaymentCharge::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
