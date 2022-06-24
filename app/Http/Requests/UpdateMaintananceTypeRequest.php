<?php

namespace App\Http\Requests;

use App\Models\MaintananceType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMaintananceTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('maintanance_type_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}
