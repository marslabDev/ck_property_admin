<?php

namespace App\Http\Requests;

use App\Models\Project;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProjectRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('project_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'areas.*' => [
                'integer',
            ],
            'areas' => [
                'required',
                'array',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'budget' => [
                'numeric',
            ],
            'suppliers.*' => [
                'integer',
            ],
            'suppliers' => [
                'required',
                'array',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
