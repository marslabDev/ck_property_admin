<?php

namespace App\Http\Requests;

use App\Models\UserCardMgmt;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserCardMgmtRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_card_mgmt_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'cardholder_name' => [
                'string',
                'required',
            ],
            'card_no' => [
                'string',
                'required',
            ],
            'card_issuer' => [
                'required',
            ],
            'expiration_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
