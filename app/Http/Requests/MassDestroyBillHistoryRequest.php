<?php

namespace App\Http\Requests;

use App\Models\BillHistory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBillHistoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bill_history_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bill_histories,id',
        ];
    }
}
