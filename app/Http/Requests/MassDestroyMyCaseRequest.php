<?php

namespace App\Http\Requests;

use App\Models\MyCase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMyCaseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('my_case_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:my_cases,id',
        ];
    }
}
