<?php

namespace App\Http\Requests;

use App\Models\HouseType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHouseTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('house_type_create');
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
            'area_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
