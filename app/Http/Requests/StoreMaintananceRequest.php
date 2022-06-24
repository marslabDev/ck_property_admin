<?php

namespace App\Http\Requests;

use App\Models\Maintanance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMaintananceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('maintanance_create');
    }

    public function rules()
    {
        return [
            'type_id' => [
                'required',
                'integer',
            ],
            'date_maintanance' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'area_id' => [
                'required',
                'integer',
            ],
            'handle_by_id' => [
                'required',
                'integer',
            ],
            'supplier_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
