<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBillItemRequest;
use App\Http\Requests\UpdateBillItemRequest;
use App\Http\Resources\Admin\BillItemResource;
use App\Models\BillItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillItemApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bill_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BillItemResource(BillItem::with(['bill_particular', 'bill', 'from_area', 'created_by'])->get());
    }

    public function store(StoreBillItemRequest $request)
    {
        $billItem = BillItem::create($request->all());

        return (new BillItemResource($billItem))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BillItem $billItem)
    {
        abort_if(Gate::denies('bill_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BillItemResource($billItem->load(['bill_particular', 'bill', 'from_area', 'created_by']));
    }

    public function update(UpdateBillItemRequest $request, BillItem $billItem)
    {
        $billItem->update($request->all());

        return (new BillItemResource($billItem))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BillItem $billItem)
    {
        abort_if(Gate::denies('bill_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billItem->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
