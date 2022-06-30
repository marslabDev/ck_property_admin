<?php

namespace App\Http\Requests;

use App\Models\ParkingLot;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateParkingLotRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('parking_lot_edit');
    }

    public function rules()
    {
        return [
            'lot_no' => [
                'string',
                'required',
            ],
        ];
    }
}
