<?php

namespace App\Http\Requests;

use App\Models\ComplaintStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateComplaintStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('complaint_status_edit');
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
