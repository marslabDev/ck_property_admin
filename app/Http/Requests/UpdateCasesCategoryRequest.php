<?php

namespace App\Http\Requests;

use App\Models\CasesCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCasesCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cases_category_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}
