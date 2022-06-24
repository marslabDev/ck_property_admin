<?php

namespace App\Http\Requests;

use App\Models\ParkingLot;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyParkingLotRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('parking_lot_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:parking_lots,id',
        ];
    }
}
