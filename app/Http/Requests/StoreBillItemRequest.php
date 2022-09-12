<?php

namespace App\Http\Requests;

use App\Models\BillItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBillItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bill_item_create');
    }

    public function rules()
    {
        return [
            'bill_particular_id' => [
                'required',
                'integer',
            ],
            'total_unit' => [
                'numeric',
                'required',
            ],
            'amount' => [
                'required',
            ],
        ];
    }
}
