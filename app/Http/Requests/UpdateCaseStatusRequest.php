<?php

namespace App\Http\Requests;

use App\Models\CaseStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCaseStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('case_status_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
