<?php

namespace App\Http\Requests;

use App\Models\ManageHouse;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateManageHouseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('manage_house_edit');
    }

    public function rules()
    {
        return [
            'unit_no' => [
                'string',
                'required',
            ],
            'contact_name' => [
                'string',
                'nullable',
            ],
            'contact_no' => [
                'numeric',
            ],
            'house_status' => [
                'required',
            ],
            'spuare_feet' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
