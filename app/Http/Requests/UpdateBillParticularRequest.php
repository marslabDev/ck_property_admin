<?php

namespace App\Http\Requests;

use App\Models\BillParticular;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBillParticularRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bill_particular_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'unit_price' => [
                'numeric',
                'required',
            ],
            'uom' => [
                'string',
                'required',
            ],
        ];
    }
}
