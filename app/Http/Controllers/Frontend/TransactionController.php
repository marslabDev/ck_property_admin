<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Models\Currency;
use App\Models\IncomeSource;
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

        $transactions = Transaction::with(['project', 'transaction_type', 'income_source', 'currency', 'created_by'])->get();

        $projects = Project::get();

        $transaction_types = TransactionType::get();

        $income_sources = IncomeSource::get();

        $currencies = Currency::get();

        $users = User::get();

        return view('frontend.transactions.index', compact('currencies', 'income_sources', 'projects', 'transaction_types', 'transactions', 'users'));
    }

    public function show(Transaction $transaction)
    {
        abort_if(Gate::denies('transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transaction->load('project', 'transaction_type', 'income_source', 'currency', 'created_by');

        return view('frontend.transactions.show', compact('transaction'));
    }
}
