<?php

namespace App\Http\Requests;

use App\Models\Checklist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateChecklistRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('checklist_edit');
    }

    public function rules()
    {
        return [
            'supplier_id' => [
                'required',
                'integer',
            ],
            'project_id' => [
                'required',
                'integer',
            ],
            'due_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
