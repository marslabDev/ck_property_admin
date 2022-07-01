<?php

namespace App\Http\Requests;

use App\Models\ManagePrice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyManagePriceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('manage_price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:manage_prices,id',
        ];
    }
}
