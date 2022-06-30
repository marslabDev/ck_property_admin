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
            'documents' => [
                'array',
            ],
            'owned_bies.*' => [
                'integer',
            ],
            'owned_bies' => [
                'array',
            ],
            'square_feet' => [
                'numeric',
                'required',
            ],
        ];
    }
}
