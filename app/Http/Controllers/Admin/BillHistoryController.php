<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Models\Area;
use App\Models\Bill;
use App\Models\BillHistory;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BillHistoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bill_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BillHistory::with(['paid_by', 'bill', 'from_area'])->select(sprintf('%s.*', (new BillHistory())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bill_history_show';
                $editGate = 'bill_history_edit';
                $deleteGate = 'bill_history_delete';
                $crudRoutePart = 'bill-histories';

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

            $table->editColumn('paid_by.email', function ($row) {
                return $row->paid_by ? (is_string($row->paid_by) ? $row->paid_by : $row->paid_by->email) : '';
            });
            $table->addColumn('bill_amount', function ($row) {
                return $row->bill ? $row->bill->amount : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'paid_by', 'bill']);

            return $table->make(true);
        }

        $users = User::get();
        $bills = Bill::get();
        $areas = Area::get();

        return view('admin.billHistories.index', compact('users', 'bills', 'areas'));
    }
}
