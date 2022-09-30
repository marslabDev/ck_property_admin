<?php

namespace App\Http\Requests;

use App\Models\BillHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBillHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bill_history_create');
    }

    public function rules()
    {
        return [
            'paid_by_id' => [
                'required',
                'integer',
            ],
            'bill_id' => [
                'required',
                'integer',
            ],
            'amount' => [
                'required',
            ],
        ];
    }
}
