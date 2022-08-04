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
            'street_id' => [
                'required',
                'integer',
            ],
            'square_feet' => [
                'numeric',
                'required',
            ],
            'parking_lots.*' => [
                'integer',
            ],
            'parking_lots' => [
                'array',
            ],
            'documents' => [
                'array',
            ],
            'house_status_id' => [
                'required',
                'integer',
            ],
            'owned_bies.*' => [
                'integer',
            ],
            'owned_bies' => [
                'array',
            ],
            'contact_person_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
