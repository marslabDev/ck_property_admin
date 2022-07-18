<?php

namespace App\Http\Requests;

use App\Models\PaymentPlan;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePaymentPlanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_plan_create');
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
                Rule::requiredIf($this->input('due_day') == null),
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'due_day' => [
                Rule::requiredIf($this->input('due_date') == null),
            ],
            'payment_items.*' => [
                'integer',
            ],
            'payment_items' => [
                'required',
                'array',
            ],
            'extra_charges.*' => [
                'integer',
            ],
            'extra_charges' => [
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
