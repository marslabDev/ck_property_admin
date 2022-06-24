<?php

namespace App\Http\Requests;

use App\Models\ComplaintSystem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyComplaintSystemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('complaint_system_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:complaint_systems,id',
        ];
    }
}
