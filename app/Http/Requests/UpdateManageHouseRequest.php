<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


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
            'floor' => [
                'string',
                Rule::requiredIf($this->input('house_type_type') == 'HIGH_RISE'),
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
