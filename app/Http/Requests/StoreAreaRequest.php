<?php

namespace App\Http\Requests;

use App\Models\Area;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAreaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('area_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'office_no' => [
                'numeric',
                'required',
            ],
            'address_line' => [
                'required',
            ],
            'city' => [
                'string',
                'required',
            ],
            'state' => [
                'string',
                'required',
            ],
            'postcode' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'country' => [
                'string',
                'required',
            ],
            'price_per_ft' => [
                'required',
            ],
        ];
    }
}
