<?php

namespace App\Http\Requests;

use App\Models\ManagePrice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreManagePriceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('manage_price_create');
    }

    public function rules()
    {
        return [
            'house_type_id' => [
                'required',
                'integer',
            ],
            'price_per_sq_ft' => [
                'required',
            ],
        ];
    }
}
