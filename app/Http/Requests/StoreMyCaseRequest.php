<?php

namespace App\Http\Requests;

use App\Models\MyCase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMyCaseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('my_case_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
            'location' => [
                'string',
                'required',
            ],
            'urgent_status' => [
                'string',
                'required',
            ],
            'progress' => [
                'string',
                'nullable',
            ],
            'date_reported' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'report_by_id' => [
                'required',
                'integer',
            ],
            'handle_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
