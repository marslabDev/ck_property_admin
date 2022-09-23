<?php

namespace App\Http\Requests;

use App\Models\BillItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBillItemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bill_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bill_items,id',
        ];
    }
}
