<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreManagePriceRequest;
use App\Http\Requests\UpdateManagePriceRequest;
use App\Http\Resources\Admin\ManagePriceResource;
use App\Models\ManagePrice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagePriceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('manage_price_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ManagePriceResource(ManagePrice::with(['house_type', 'from_area', 'created_by'])->get());
    }

    public function store(StoreManagePriceRequest $request)
    {
        $managePrice = ManagePrice::create($request->all());

        return (new ManagePriceResource($managePrice))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ManagePrice $managePrice)
    {
        abort_if(Gate::denies('manage_price_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ManagePriceResource($managePrice->load(['house_type', 'from_area', 'created_by']));
    }

    public function update(UpdateManagePriceRequest $request, ManagePrice $managePrice)
    {
        $managePrice->update($request->all());

        return (new ManagePriceResource($managePrice))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ManagePrice $managePrice)
    {
        abort_if(Gate::denies('manage_price_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $managePrice->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
