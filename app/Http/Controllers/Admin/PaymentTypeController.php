<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPaymentTypeRequest;
use App\Http\Requests\StorePaymentTypeRequest;
use App\Http\Requests\UpdatePaymentTypeRequest;
use App\Models\PaymentType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PaymentTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('payment_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PaymentType::with(['created_by'])->select(sprintf('%s.*', (new PaymentType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'payment_type_show';
                $editGate = 'payment_type_edit';
                $deleteGate = 'payment_type_delete';
                $crudRoutePart = 'payment-types';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.paymentTypes.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paymentTypes.create');
    }

    public function store(StorePaymentTypeRequest $request)
    {
        $paymentType = PaymentType::create($request->all());

        return redirect()->route('admin.payment-types.index');
    }

    public function edit(PaymentType $paymentType)
    {
        abort_if(Gate::denies('payment_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentType->load('created_by');

        return view('admin.paymentTypes.edit', compact('paymentType'));
    }

    public function update(UpdatePaymentTypeRequest $request, PaymentType $paymentType)
    {
        $paymentType->update($request->all());

        return redirect()->route('admin.payment-types.index');
    }

    public function show(PaymentType $paymentType)
    {
        abort_if(Gate::denies('payment_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentType->load('created_by', 'paymentTypePaymentHistories', 'paymentTypeHomeOwnerTransactions');

        return view('admin.paymentTypes.show', compact('paymentType'));
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
