<?php

namespace App\Http\Requests;

use App\Models\Bill;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBillRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bill_create');
    }

    public function rules()
    {
        return [
            'billplz' => [
                'string',
                'required',
                'unique:bills',
            ],
            'billplz_url' => [
                'string',
                'required',
            ],
            'house_id' => [
                'required',
                'integer',
            ],
            'homeowner_id' => [
                'required',
                'integer',
            ],
            'billing_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'due_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'bill_items.*' => [
                'integer',
            ],
            'bill_items' => [
                'required',
                'array',
            ],
            'bill_charges.*' => [
                'integer',
            ],
            'bill_charges' => [
                'array',
            ],
            'amount' => [
                'required',
            ],
            'bill_status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
