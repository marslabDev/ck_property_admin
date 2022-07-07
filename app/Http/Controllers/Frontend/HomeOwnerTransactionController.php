<?php

namespace App\Http\Controllers\Frontend;

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

class HomeOwnerTransactionController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('home_owner_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homeOwnerTransactions = HomeOwnerTransaction::with(['user', 'house', 'payment_plan', 'payment_type', 'created_by'])->get();

        $users = User::get();

        $manage_houses = ManageHouse::get();

        $payment_plans = PaymentPlan::get();

        $payment_types = PaymentType::get();

        return view('frontend.homeOwnerTransactions.index', compact('homeOwnerTransactions', 'manage_houses', 'payment_plans', 'payment_types', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('home_owner_transaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $houses = ManageHouse::pluck('unit_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_plans = PaymentPlan::pluck('due_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_types = PaymentType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.homeOwnerTransactions.create', compact('houses', 'payment_plans', 'payment_types', 'users'));
    }

    public function store(StoreHomeOwnerTransactionRequest $request)
    {
        $homeOwnerTransaction = HomeOwnerTransaction::create($request->all());

        return redirect()->route('frontend.home-owner-transactions.index');
    }

    public function edit(HomeOwnerTransaction $homeOwnerTransaction)
    {
        abort_if(Gate::denies('home_owner_transaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $houses = ManageHouse::pluck('unit_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_plans = PaymentPlan::pluck('due_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $payment_types = PaymentType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $homeOwnerTransaction->load('user', 'house', 'payment_plan', 'payment_type', 'created_by');

        return view('frontend.homeOwnerTransactions.edit', compact('homeOwnerTransaction', 'houses', 'payment_plans', 'payment_types', 'users'));
    }

    public function update(UpdateHomeOwnerTransactionRequest $request, HomeOwnerTransaction $homeOwnerTransaction)
    {
        $homeOwnerTransaction->update($request->all());

        return redirect()->route('frontend.home-owner-transactions.index');
    }

    public function show(HomeOwnerTransaction $homeOwnerTransaction)
    {
        abort_if(Gate::denies('home_owner_transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homeOwnerTransaction->load('user', 'house', 'payment_plan', 'payment_type', 'created_by');

        return view('frontend.homeOwnerTransactions.show', compact('homeOwnerTransaction'));
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
