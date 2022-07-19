<?php

namespace App\Http\Requests;

use App\Models\OpenProject;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOpenProjectRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('open_project_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:open_projects,id',
        ];
    }
}
