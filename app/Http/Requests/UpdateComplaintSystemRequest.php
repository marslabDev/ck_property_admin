<?php

namespace App\Http\Requests;

use App\Models\ComplaintSystem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateComplaintSystemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('complaint_system_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
            'status' => [
                'string',
                'nullable',
            ],
        ];
    }
}
