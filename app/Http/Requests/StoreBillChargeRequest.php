<?php

namespace App\Http\Requests;

use App\Models\BillCharge;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBillChargeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bill_charge_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'type' => [
                'required',
            ],
            'rate' => [
                'numeric',
                'required',
            ],
        ];
    }
}
