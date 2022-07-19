<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Client;
use App\Models\Currency;
use App\Models\Project;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactions = Transaction::with(['project', 'transaction_type', 'supplier', 'currency', 'created_by'])->get();

        $projects = Project::get();

        $transaction_types = TransactionType::get();

        $clients = Client::get();

        $currencies = Currency::get();

        $users = User::get();

        return view('frontend.transactions.index', compact('clients', 'currencies', 'projects', 'transaction_types', 'transactions', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transaction_types = TransactionType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suppliers = Client::pluck('company', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.transactions.create', compact('currencies', 'projects', 'suppliers', 'transaction_types'));
    }

    public function store(StoreTransactionRequest $request)
    {
        $transaction = Transaction::create($request->all());

        return redirect()->route('frontend.transactions.index');
    }

    public function show(Transaction $transaction)
    {
        abort_if(Gate::denies('transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transaction->load('project', 'transaction_type', 'supplier', 'currency', 'created_by');

        return view('frontend.transactions.show', compact('transaction'));
    }
}
