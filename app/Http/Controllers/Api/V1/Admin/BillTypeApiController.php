<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBillTypeRequest;
use App\Http\Requests\UpdateBillTypeRequest;
use App\Http\Resources\Admin\BillTypeResource;
use App\Models\BillType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bill_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BillTypeResource(BillType::with(['from_area', 'created_by'])->get());
    }

    public function store(StoreBillTypeRequest $request)
    {
        $billType = BillType::create($request->all());

        return (new BillTypeResource($billType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BillType $billType)
    {
        abort_if(Gate::denies('bill_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BillTypeResource($billType->load(['from_area', 'created_by']));
    }

    public function update(UpdateBillTypeRequest $request, BillType $billType)
    {
        $billType->update($request->all());

        return (new BillTypeResource($billType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BillType $billType)
    {
        abort_if(Gate::denies('bill_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
