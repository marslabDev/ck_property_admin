<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBillStatusRequest;
use App\Http\Requests\UpdateBillStatusRequest;
use App\Http\Resources\Admin\BillStatusResource;
use App\Models\BillStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bill_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BillStatusResource(BillStatus::with(['from_area', 'created_by'])->get());
    }

    public function store(StoreBillStatusRequest $request)
    {
        $billStatus = BillStatus::create($request->all());

        return (new BillStatusResource($billStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BillStatus $billStatus)
    {
        abort_if(Gate::denies('bill_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BillStatusResource($billStatus->load(['from_area', 'created_by']));
    }

    public function update(UpdateBillStatusRequest $request, BillStatus $billStatus)
    {
        $billStatus->update($request->all());

        return (new BillStatusResource($billStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BillStatus $billStatus)
    {
        abort_if(Gate::denies('bill_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
