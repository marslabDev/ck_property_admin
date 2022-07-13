<?php

namespace App\Http\Requests;

use App\Models\Checklist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyChecklistRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('checklist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:checklists,id',
        ];
    }
}
