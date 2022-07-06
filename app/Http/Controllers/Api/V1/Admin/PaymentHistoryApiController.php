<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\PaymentHistoryResource;
use App\Models\PaymentHistory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentHistoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payment_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PaymentHistoryResource(PaymentHistory::with(['paid_by', 'payment_type'])->get());
    }
}
