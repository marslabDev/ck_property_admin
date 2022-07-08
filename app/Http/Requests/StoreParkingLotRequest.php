<?php

namespace App\Http\Requests;

use App\Models\ParkingLot;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreParkingLotRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('parking_lot_create');
    }

    public function rules()
    {
        return [
            'lot_no' => [
                'string',
                'required',
            ],
            'floor' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
