<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySupplierTransactionRequest;
use App\Http\Requests\StoreSupplierTransactionRequest;
use App\Http\Requests\UpdateSupplierTransactionRequest;
use App\Models\Currency;
use App\Models\IncomeSource;
use App\Models\Project;
use App\Models\SupplierTransaction;
use App\Models\TransactionType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupplierTransactionController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('supplier_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplierTransactions = SupplierTransaction::with(['project', 'transaction_type', 'income_source', 'currency', 'created_by'])->get();

        $projects = Project::get();

        $transaction_types = TransactionType::get();

        $income_sources = IncomeSource::get();

        $currencies = Currency::get();

        $users = User::get();

        return view('frontend.supplierTransactions.index', compact('currencies', 'income_sources', 'projects', 'supplierTransactions', 'transaction_types', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('supplier_transaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transaction_types = TransactionType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $income_sources = IncomeSource::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.supplierTransactions.create', compact('currencies', 'income_sources', 'projects', 'transaction_types'));
    }

    public function store(StoreSupplierTransactionRequest $request)
    {
        $supplierTransaction = SupplierTransaction::create($request->all());

        return redirect()->route('frontend.supplier-transactions.index');
    }

    public function edit(SupplierTransaction $supplierTransaction)
    {
        abort_if(Gate::denies('supplier_transaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transaction_types = TransactionType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $income_sources = IncomeSource::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $supplierTransaction->load('project', 'transaction_type', 'income_source', 'currency', 'created_by');

        return view('frontend.supplierTransactions.edit', compact('currencies', 'income_sources', 'projects', 'supplierTransaction', 'transaction_types'));
    }

    public function update(UpdateSupplierTransactionRequest $request, SupplierTransaction $supplierTransaction)
    {
        $supplierTransaction->update($request->all());

        return redirect()->route('frontend.supplier-transactions.index');
    }

    public function show(SupplierTransaction $supplierTransaction)
    {
        abort_if(Gate::denies('supplier_transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplierTransaction->load('project', 'transaction_type', 'income_source', 'currency', 'created_by');

        return view('frontend.supplierTransactions.show', compact('supplierTransaction'));
    }

    public function destroy(SupplierTransaction $supplierTransaction)
    {
        abort_if(Gate::denies('supplier_transaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplierTransaction->delete();

        return back();
    }

    public function massDestroy(MassDestroySupplierTransactionRequest $request)
    {
        SupplierTransaction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
