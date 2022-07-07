<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class PaymentItemController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('payment_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PaymentItem::with(['created_by'])->select(sprintf('%s.*', (new PaymentItem())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'payment_item_show';
                $editGate = 'payment_item_edit';
                $deleteGate = 'payment_item_delete';
                $crudRoutePart = 'payment-items';

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
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? PaymentItem::TYPE_SELECT[$row->type] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.paymentItems.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.paymentItems.create');
    }

    public function store(StorePaymentItemRequest $request)
    {
        $paymentItem = PaymentItem::create($request->all());

        return redirect()->route('admin.payment-items.index');
    }

    public function edit(PaymentItem $paymentItem)
    {
        abort_if(Gate::denies('payment_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentItem->load('created_by');

        return view('admin.paymentItems.edit', compact('paymentItem'));
    }

    public function update(UpdatePaymentItemRequest $request, PaymentItem $paymentItem)
    {
        $paymentItem->update($request->all());

        return redirect()->route('admin.payment-items.index');
    }

    public function show(PaymentItem $paymentItem)
    {
        abort_if(Gate::denies('payment_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentItem->load('created_by', 'paymentItemPaymentPlans');

        return view('admin.paymentItems.show', compact('paymentItem'));
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
