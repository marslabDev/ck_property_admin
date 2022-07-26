<?php

namespace App\Http\Requests;

use App\Models\Complaint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateComplaintRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('complaint_edit');
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
            'status_id' => [
                'required',
                'integer',
            ],
            'image' => [
                'array',
            ],
        ];
    }
}
