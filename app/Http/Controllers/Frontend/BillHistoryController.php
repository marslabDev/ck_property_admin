<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Models\Area;
use App\Models\Bill;
use App\Models\BillHistory;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillHistoryController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bill_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billHistories = BillHistory::with(['paid_by', 'bill', 'from_area'])->get();

        $users = User::get();

        $bills = Bill::get();

        $areas = Area::get();

        return view('frontend.billHistories.index', compact('areas', 'billHistories', 'bills', 'users'));
    }
}
