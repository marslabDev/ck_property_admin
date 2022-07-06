<?php

namespace App\Http\Requests;

use App\Models\Street;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyStreetRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('street_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:streets,id',
        ];
    }
}
