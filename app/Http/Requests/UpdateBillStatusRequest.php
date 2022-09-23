<?php

namespace App\Http\Requests;

use App\Models\BillStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBillStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bill_status_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
