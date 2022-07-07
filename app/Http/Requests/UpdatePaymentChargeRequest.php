<?php

namespace App\Http\Requests;

use App\Models\PaymentCharge;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePaymentChargeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_charge_edit');
    }

    public function rules()
    {
        return [
            'particular' => [
                'string',
                'required',
            ],
            'type' => [
                'required',
            ],
            'amount' => [
                'required',
            ],
        ];
    }
}
