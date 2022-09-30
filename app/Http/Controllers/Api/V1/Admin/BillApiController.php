<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Http\Resources\Admin\BillResource;
use App\Models\Bill;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BillResource(Bill::with(['bill_type', 'house', 'homeowner', 'bill_items', 'bill_charges', 'bill_status', 'from_area', 'created_by'])->get());
    }

    public function store(StoreBillRequest $request)
    {
        $bill = Bill::create($request->all());
        $bill->bill_items()->sync($request->input('bill_items', []));
        $bill->bill_charges()->sync($request->input('bill_charges', []));

        return (new BillResource($bill))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Bill $bill)
    {
        abort_if(Gate::denies('bill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BillResource($bill->load(['bill_type', 'house', 'homeowner', 'bill_items', 'bill_charges', 'bill_status', 'from_area', 'created_by']));
    }

    public function update(UpdateBillRequest $request, Bill $bill)
    {
        $bill->update($request->all());
        $bill->bill_items()->sync($request->input('bill_items', []));
        $bill->bill_charges()->sync($request->input('bill_charges', []));

        return (new BillResource($bill))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Bill $bill)
    {
        abort_if(Gate::denies('bill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
