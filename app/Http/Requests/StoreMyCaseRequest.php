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
            'opened_at' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'complaints.*' => [
                'integer',
            ],
            'complaints' => [
                'required',
                'array',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
            'image' => [
                'array',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
            'handle_by_id' => [
                'required',
                'integer',
            ],
            'report_to_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
