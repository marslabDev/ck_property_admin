<?php

namespace App\Http\Requests;

use App\Models\ComplaintSystem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreComplaintSystemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('complaint_system_create');
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
