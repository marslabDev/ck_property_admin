<?php

namespace App\Http\Requests;

use App\Models\CaseStatus;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class StoreCaseStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('case_status_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'status_linking' => [
                'required',
            ],
            'complaint_status_id' => [
                Rule::requiredIf($this->input('status_linking') == '1'),
            ],
        ];
    }
}
