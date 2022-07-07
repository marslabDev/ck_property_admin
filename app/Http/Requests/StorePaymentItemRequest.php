<?php

namespace App\Http\Requests;

use App\Models\PaymentItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePaymentItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_item_create');
    }

    public function rules()
    {
        return [
            'particular' => [
                'required',
            ],
            'amount' => [
                'required',
            ],
            'type' => [
                'required',
            ],
        ];
    }
}
