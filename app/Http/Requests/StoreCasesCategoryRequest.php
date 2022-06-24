<?php

namespace App\Http\Requests;

use App\Models\CasesCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCasesCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cases_category_create');
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
