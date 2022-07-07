<?php

namespace App\Http\Requests;

use App\Models\HomeOwnerTransaction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHomeOwnerTransactionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('home_owner_transaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:home_owner_transactions,id',
        ];
    }
}
