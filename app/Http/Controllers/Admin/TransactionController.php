<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Transaction::with(['project', 'transaction_type', 'supplier', 'currency', 'created_by'])->select(sprintf('%s.*', (new Transaction())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'transaction_show';
                $editGate = 'transaction_edit';
                $deleteGate = 'transaction_delete';
                $crudRoutePart = 'transactions';

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

            $table->addColumn('supplier_company', function ($row) {
                return $row->supplier ? $row->supplier->company : '';
            });

            $table->editColumn('supplier.email', function ($row) {
                return $row->supplier ? (is_string($row->supplier) ? $row->supplier : $row->supplier->email) : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->addColumn('currency_name', function ($row) {
                return $row->currency ? $row->currency->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'project', 'transaction_type', 'supplier', 'currency']);

            return $table->make(true);
        }

        $projects          = Project::get();
        $transaction_types = TransactionType::get();
        $clients           = Client::get();
        $currencies        = Currency::get();
        $users             = User::get();

        return view('admin.transactions.index', compact('projects', 'transaction_types', 'clients', 'currencies', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transaction_types = TransactionType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suppliers = Client::pluck('company', 'id')->prepend(trans('global.pleaseSelect'), '');

        $currencies = Currency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transactions.create', compact('currencies', 'projects', 'suppliers', 'transaction_types'));
    }

    public function store(StoreTransactionRequest $request)
    {
        $transaction = Transaction::create($request->all());

        return redirect()->route('admin.transactions.index');
    }

    public function show(Transaction $transaction)
    {
        abort_if(Gate::denies('transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transaction->load('project', 'transaction_type', 'supplier', 'currency', 'created_by');

        return view('admin.transactions.show', compact('transaction'));
    }
}
