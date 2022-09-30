<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\BillHistoryResource;
use App\Models\BillHistory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillHistoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bill_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BillHistoryResource(BillHistory::with(['paid_by', 'bill', 'from_area'])->get());
    }
}
