<?php

namespace App\Http\Requests;

use App\Models\PaymentHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePaymentHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_history_create');
    }

    public function rules()
    {
        return [];
    }
}
