<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Models\PaymentHistory;
use App\Models\PaymentType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentHistoryController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('payment_history_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentHistories = PaymentHistory::with(['paid_by', 'payment_type'])->get();

        $users = User::get();

        $payment_types = PaymentType::get();

        return view('frontend.paymentHistories.index', compact('paymentHistories', 'payment_types', 'users'));
    }
}
