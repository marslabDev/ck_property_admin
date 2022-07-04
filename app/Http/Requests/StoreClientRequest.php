<?php

namespace App\Http\Requests;

use App\Models\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_create');
    }

    public function rules()
    {
        return [
            'person_in_change' => [
                'string',
                'required',
            ],
            'company' => [
                'string',
                'nullable',
            ],
            'desc' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'website' => [
                'string',
                'nullable',
            ],
            'whatapps' => [
                'string',
                'required',
            ],
            'country' => [
                'string',
                'nullable',
            ],
        ];
    }
}
