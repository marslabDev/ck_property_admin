<?php

namespace App\Http\Requests;

use App\Models\HouseStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHouseStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('house_status_create');
    }

    public function rules()
    {
        return [
            'status' => [
                'string',
                'required',
            ],
        ];
    }
}
