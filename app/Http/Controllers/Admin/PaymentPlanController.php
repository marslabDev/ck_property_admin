<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class PaymentPlanController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('payment_plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PaymentPlan::with(['user', 'house', 'payment_items', 'created_by'])->select(sprintf('%s.*', (new PaymentPlan())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'payment_plan_show';
                $editGate = 'payment_plan_edit';
                $deleteGate = 'payment_plan_delete';
                $crudRoutePart = 'payment-plans';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user.email', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });
            $table->addColumn('house_unit_no', function ($row) {
                return $row->house ? $row->house->unit_no : '';
            });

            $table->editColumn('payment_item', function ($row) {
                $labels = [];
                foreach ($row->payment_items as $payment_item) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $payment_item->particular);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('recusive_payment', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->recusive_payment ? 'checked' : null) . '>';
            });
            $table->editColumn('cycle_every', function ($row) {
                return $row->cycle_every ? $row->cycle_every : '';
            });
            $table->editColumn('cycle_by', function ($row) {
                return $row->cycle_by ? PaymentPlan::CYCLE_BY_SELECT[$row->cycle_by] : '';
            });
            $table->editColumn('no_of_cycle', function ($row) {
                return $row->no_of_cycle ? $row->no_of_cycle : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'house', 'payment_item', 'recusive_payment']);

            return $table->make(true);
        }

        $users         = User::get();
        $manage_houses = ManageHouse::get();
        $payment_items = PaymentItem::get();

        return view('admin.paymentPlans.index', compact('users', 'manage_houses', 'payment_items'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_plan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $houses = ManageHouse::pluck('unit_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_items = PaymentItem::pluck('particular', 'id');

        return view('admin.paymentPlans.create', compact('houses', 'payment_items', 'users'));
    }

    public function store(StorePaymentPlanRequest $request)
    {
        $paymentPlan = PaymentPlan::create($request->all());
        $paymentPlan->payment_items()->sync($request->input('payment_items', []));

        return redirect()->route('admin.payment-plans.index');
    }

    public function edit(PaymentPlan $paymentPlan)
    {
        abort_if(Gate::denies('payment_plan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $houses = ManageHouse::pluck('unit_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_items = PaymentItem::pluck('particular', 'id');

        $paymentPlan->load('user', 'house', 'payment_items', 'created_by');

        return view('admin.paymentPlans.edit', compact('houses', 'paymentPlan', 'payment_items', 'users'));
    }

    public function update(UpdatePaymentPlanRequest $request, PaymentPlan $paymentPlan)
    {
        $paymentPlan->update($request->all());
        $paymentPlan->payment_items()->sync($request->input('payment_items', []));

        return redirect()->route('admin.payment-plans.index');
    }

    public function show(PaymentPlan $paymentPlan)
    {
        abort_if(Gate::denies('payment_plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentPlan->load('user', 'house', 'payment_items', 'created_by', 'paymentPlanHomeOwnerTransactions');

        return view('admin.paymentPlans.show', compact('paymentPlan'));
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
