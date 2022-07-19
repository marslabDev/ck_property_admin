<?php

namespace App\Http\Requests;

use App\Models\OpenProject;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOpenProjectRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('open_project_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'documents' => [
                'array',
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
            'end_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
