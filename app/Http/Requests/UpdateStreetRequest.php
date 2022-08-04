<?php

namespace App\Http\Requests;

use App\Models\Street;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStreetRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('street_edit');
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
