<?php

namespace App\Http\Requests;

use App\Models\UserDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_detail_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'ic_no' => [
                'string',
                'required',
            ],
            'date_of_birth' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'city' => [
                'string',
                'required',
            ],
            'postcode' => [
                'string',
                'required',
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
