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
            'city' => [
                'string',
                'required',
            ],
            'postcode' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'state' => [
                'string',
                'required',
            ],
            'country' => [
                'string',
                'required',
            ],
        ];
    }
}
