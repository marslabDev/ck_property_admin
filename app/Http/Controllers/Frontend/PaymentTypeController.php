<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPaymentTypeRequest;
use App\Http\Requests\StorePaymentTypeRequest;
use App\Http\Requests\UpdatePaymentTypeRequest;
use App\Models\Area;
use App\Models\PaymentType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentTypeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('payment_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentTypes = PaymentType::with(['from_area', 'created_by'])->get();

        $areas = Area::get();

        $users = User::get();

        return view('frontend.paymentTypes.index', compact('areas', 'paymentTypes', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.paymentTypes.create');
    }

    public function store(StorePaymentTypeRequest $request)
    {
        $paymentType = PaymentType::create($request->all());

        return redirect()->route('frontend.payment-types.index');
    }

    public function edit(PaymentType $paymentType)
    {
        abort_if(Gate::denies('payment_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentType->load('from_area', 'created_by');

        return view('frontend.paymentTypes.edit', compact('paymentType'));
    }

    public function update(UpdatePaymentTypeRequest $request, PaymentType $paymentType)
    {
        $paymentType->update($request->all());

        return redirect()->route('frontend.payment-types.index');
    }

    public function show(PaymentType $paymentType)
    {
        abort_if(Gate::denies('payment_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentType->load('from_area', 'created_by', 'paymentTypePaymentHistories', 'paymentTypeHomeOwnerTransactions');

        return view('frontend.paymentTypes.show', compact('paymentType'));
    }

    public function destroy(PaymentType $paymentType)
    {
        abort_if(Gate::denies('payment_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentType->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaymentTypeRequest $request)
    {
        PaymentType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
