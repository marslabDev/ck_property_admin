<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class SupplierTransactionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('supplier_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SupplierTransaction::with(['project', 'transaction_type', 'income_source', 'currency', 'created_by'])->select(sprintf('%s.*', (new SupplierTransaction())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'supplier_transaction_show';
                $editGate = 'supplier_transaction_edit';
                $deleteGate = 'supplier_transaction_delete';
                $crudRoutePart = 'supplier-transactions';

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
            $table->addColumn('project_name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->addColumn('transaction_type_name', function ($row) {
                return $row->transaction_type ? $row->transaction_type->name : '';
            });

            $table->addColumn('income_source_name', function ($row) {
                return $row->income_source ? $row->income_source->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->addColumn('currency_name', function ($row) {
                return $row->currency ? $row->currency->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'project', 'transaction_type', 'income_source', 'currency']);

            return $table->make(true);
        }

        $projects          = Project::get();
        $transaction_types = TransactionType::get();
        $income_sources    = IncomeSource::get();
        $currencies        = Currency::get();
        $users             = User::get();

        return view('admin.supplierTransactions.index', compact('projects', 'transaction_types', 'income_sources', 'currencies', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('supplier_transaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transaction_types = TransactionType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $income_sources = IncomeSource::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.supplierTransactions.create', compact('currencies', 'income_sources', 'projects', 'transaction_types'));
    }

    public function store(StoreSupplierTransactionRequest $request)
    {
        $supplierTransaction = SupplierTransaction::create($request->all());

        return redirect()->route('admin.supplier-transactions.index');
    }

    public function edit(SupplierTransaction $supplierTransaction)
    {
        abort_if(Gate::denies('supplier_transaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transaction_types = TransactionType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $income_sources = IncomeSource::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $supplierTransaction->load('project', 'transaction_type', 'income_source', 'currency', 'created_by');

        return view('admin.supplierTransactions.edit', compact('currencies', 'income_sources', 'projects', 'supplierTransaction', 'transaction_types'));
    }

    public function update(UpdateSupplierTransactionRequest $request, SupplierTransaction $supplierTransaction)
    {
        $supplierTransaction->update($request->all());

        return redirect()->route('admin.supplier-transactions.index');
    }

    public function show(SupplierTransaction $supplierTransaction)
    {
        abort_if(Gate::denies('supplier_transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplierTransaction->load('project', 'transaction_type', 'income_source', 'currency', 'created_by');

        return view('admin.supplierTransactions.show', compact('supplierTransaction'));
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
