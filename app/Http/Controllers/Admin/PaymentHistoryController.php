<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Models\PaymentHistory;
use App\Models\PaymentType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PaymentHistoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('payment_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PaymentHistory::with(['paid_by', 'payment_type'])->select(sprintf('%s.*', (new PaymentHistory())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'payment_history_show';
                $editGate = 'payment_history_edit';
                $deleteGate = 'payment_history_delete';
                $crudRoutePart = 'payment-histories';

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
            $table->addColumn('paid_by_name', function ($row) {
                return $row->paid_by ? $row->paid_by->name : '';
            });

            $table->addColumn('payment_type_name', function ($row) {
                return $row->payment_type ? $row->payment_type->name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'paid_by', 'payment_type']);

            return $table->make(true);
        }

        $users         = User::get();
        $payment_types = PaymentType::get();

        return view('admin.paymentHistories.index', compact('users', 'payment_types'));
    }
}
