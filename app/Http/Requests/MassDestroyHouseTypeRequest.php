<?php

namespace App\Http\Requests;

use App\Models\HouseType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHouseTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('house_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:house_types,id',
        ];
    }
}
