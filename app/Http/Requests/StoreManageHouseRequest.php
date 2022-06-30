<?php

namespace App\Http\Requests;

use App\Models\ManageHouse;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreManageHouseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('manage_house_create');
    }

    public function rules()
    {
        return [
            'unit_no' => [
                'string',
                'required',
            ],
            'floor' => [
                'string',
                'nullable',
            ],
            'block' => [
                'string',
                'nullable',
            ],
            'street' => [
                'string',
                'required',
            ],
            'taman' => [
                'string',
                'required',
            ],
            'square_feet' => [
                'numeric',
                'required',
            ],
            'house_status' => [
                'required',
            ],
            'documents' => [
                'array',
            ],
            'owned_bies.*' => [
                'integer',
            ],
            'owned_bies' => [
                'array',
            ],
        ];
    }
}
