<?php

namespace App\Http\Requests;

use App\Models\HouseType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHouseTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('house_type_edit');
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
