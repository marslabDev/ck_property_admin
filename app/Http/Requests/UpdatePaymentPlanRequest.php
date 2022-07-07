<?php

namespace App\Http\Requests;

use App\Models\PaymentPlan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePaymentPlanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_plan_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'house_id' => [
                'required',
                'integer',
            ],
            'due_date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'payment_items.*' => [
                'integer',
            ],
            'payment_items' => [
                'required',
                'array',
            ],
            'cycle_every' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'no_of_cycle' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
