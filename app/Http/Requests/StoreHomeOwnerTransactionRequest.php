<?php

namespace App\Http\Requests;

use App\Models\HomeOwnerTransaction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHomeOwnerTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('home_owner_transaction_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'house_id' => [
                'required',
                'integer',
            ],
            'payment_plan_id' => [
                'required',
                'integer',
            ],
            'payment_type_id' => [
                'required',
                'integer',
            ],
            'amount_paid' => [
                'required',
            ],
            'changes' => [
                'required',
            ],
        ];
    }
}
