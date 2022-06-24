<?php

namespace App\Http\Requests;

use App\Models\Maintanance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMaintananceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('maintanance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:maintanances,id',
        ];
    }
}
