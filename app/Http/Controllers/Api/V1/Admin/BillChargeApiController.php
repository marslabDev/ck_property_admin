<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBillChargeRequest;
use App\Http\Requests\UpdateBillChargeRequest;
use App\Http\Resources\Admin\BillChargeResource;
use App\Models\BillCharge;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillChargeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bill_charge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BillChargeResource(BillCharge::with(['from_area', 'created_by'])->get());
    }

    public function store(StoreBillChargeRequest $request)
    {
        $billCharge = BillCharge::create($request->all());

        return (new BillChargeResource($billCharge))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BillCharge $billCharge)
    {
        abort_if(Gate::denies('bill_charge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BillChargeResource($billCharge->load(['from_area', 'created_by']));
    }

    public function update(UpdateBillChargeRequest $request, BillCharge $billCharge)
    {
        $billCharge->update($request->all());

        return (new BillChargeResource($billCharge))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BillCharge $billCharge)
    {
        abort_if(Gate::denies('bill_charge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billCharge->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
