<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class PaymentChargeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('payment_charge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PaymentCharge::with(['created_by'])->select(sprintf('%s.*', (new PaymentCharge())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'payment_charge_show';
                $editGate = 'payment_charge_edit';
                $deleteGate = 'payment_charge_delete';
                $crudRoutePart = 'payment-charges';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('particular', function ($row) {
                return $row->particular ? $row->particular : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? PaymentCharge::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.paymentCharges.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_charge_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paymentCharges.create');
    }

    public function store(StorePaymentChargeRequest $request)
    {
        $paymentCharge = PaymentCharge::create($request->all());

        return redirect()->route('admin.payment-charges.index');
    }

    public function edit(PaymentCharge $paymentCharge)
    {
        abort_if(Gate::denies('payment_charge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentCharge->load('created_by');

        return view('admin.paymentCharges.edit', compact('paymentCharge'));
    }

    public function update(UpdatePaymentChargeRequest $request, PaymentCharge $paymentCharge)
    {
        $paymentCharge->update($request->all());

        return redirect()->route('admin.payment-charges.index');
    }

    public function show(PaymentCharge $paymentCharge)
    {
        abort_if(Gate::denies('payment_charge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentCharge->load('created_by', 'extraChargePaymentPlans');

        return view('admin.paymentCharges.show', compact('paymentCharge'));
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
