<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHomeOwnerTransactionRequest;
use App\Http\Requests\StoreHomeOwnerTransactionRequest;
use App\Http\Requests\UpdateHomeOwnerTransactionRequest;
use App\Models\HomeOwnerTransaction;
use App\Models\ManageHouse;
use App\Models\PaymentPlan;
use App\Models\PaymentType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HomeOwnerTransactionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('home_owner_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HomeOwnerTransaction::with(['user', 'house', 'payment_plan', 'payment_type', 'created_by'])->select(sprintf('%s.*', (new HomeOwnerTransaction())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'home_owner_transaction_show';
                $editGate = 'home_owner_transaction_edit';
                $deleteGate = 'home_owner_transaction_delete';
                $crudRoutePart = 'home-owner-transactions';

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

            $table->addColumn('payment_plan_due_date', function ($row) {
                return $row->payment_plan ? $row->payment_plan->due_date : '';
            });

            $table->addColumn('payment_type_name', function ($row) {
                return $row->payment_type ? $row->payment_type->name : '';
            });

            $table->editColumn('amount_paid', function ($row) {
                return $row->amount_paid ? $row->amount_paid : '';
            });
            $table->editColumn('changes', function ($row) {
                return $row->changes ? $row->changes : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'house', 'payment_plan', 'payment_type']);

            return $table->make(true);
        }

        $users         = User::get();
        $manage_houses = ManageHouse::get();
        $payment_plans = PaymentPlan::get();
        $payment_types = PaymentType::get();

        return view('admin.homeOwnerTransactions.index', compact('users', 'manage_houses', 'payment_plans', 'payment_types'));
    }

    public function create()
    {
        abort_if(Gate::denies('home_owner_transaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $houses = ManageHouse::pluck('unit_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_plans = PaymentPlan::pluck('due_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_types = PaymentType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.homeOwnerTransactions.create', compact('houses', 'payment_plans', 'payment_types', 'users'));
    }

    public function store(StoreHomeOwnerTransactionRequest $request)
    {
        $homeOwnerTransaction = HomeOwnerTransaction::create($request->all());

        return redirect()->route('admin.home-owner-transactions.index');
    }

    public function edit(HomeOwnerTransaction $homeOwnerTransaction)
    {
        abort_if(Gate::denies('home_owner_transaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $houses = ManageHouse::pluck('unit_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_plans = PaymentPlan::pluck('due_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_types = PaymentType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $homeOwnerTransaction->load('user', 'house', 'payment_plan', 'payment_type', 'created_by');

        return view('admin.homeOwnerTransactions.edit', compact('homeOwnerTransaction', 'houses', 'payment_plans', 'payment_types', 'users'));
    }

    public function update(UpdateHomeOwnerTransactionRequest $request, HomeOwnerTransaction $homeOwnerTransaction)
    {
        $homeOwnerTransaction->update($request->all());

        return redirect()->route('admin.home-owner-transactions.index');
    }

    public function show(HomeOwnerTransaction $homeOwnerTransaction)
    {
        abort_if(Gate::denies('home_owner_transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homeOwnerTransaction->load('user', 'house', 'payment_plan', 'payment_type', 'created_by');

        return view('admin.homeOwnerTransactions.show', compact('homeOwnerTransaction'));
    }

    public function destroy(HomeOwnerTransaction $homeOwnerTransaction)
    {
        abort_if(Gate::denies('home_owner_transaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homeOwnerTransaction->delete();

        return back();
    }

    public function massDestroy(MassDestroyHomeOwnerTransactionRequest $request)
    {
        HomeOwnerTransaction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
