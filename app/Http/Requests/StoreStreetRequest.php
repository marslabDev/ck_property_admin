<?php

namespace App\Http\Requests;

use App\Models\Street;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStreetRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('street_create');
    }

    public function rules()
    {
        return [
            'street_name' => [
                'required',
            ],
        ];
    }
}
