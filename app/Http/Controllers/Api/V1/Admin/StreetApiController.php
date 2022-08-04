<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStreetRequest;
use App\Http\Requests\UpdateStreetRequest;
use App\Http\Resources\Admin\StreetResource;
use App\Models\Street;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StreetApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('street_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StreetResource(Street::with(['from_area', 'created_by'])->get());
    }

    public function store(StoreStreetRequest $request)
    {
        $street = Street::create($request->all());

        return (new StreetResource($street))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Street $street)
    {
        abort_if(Gate::denies('street_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StreetResource($street->load(['from_area', 'created_by']));
    }

    public function update(UpdateStreetRequest $request, Street $street)
    {
        $street->update($request->all());

        return (new StreetResource($street))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Street $street)
    {
        abort_if(Gate::denies('street_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $street->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
