<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBillParticularRequest;
use App\Http\Requests\UpdateBillParticularRequest;
use App\Http\Resources\Admin\BillParticularResource;
use App\Models\BillParticular;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillParticularApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('bill_particular_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BillParticularResource(BillParticular::with(['from_area', 'created_by'])->get());
    }

    public function store(StoreBillParticularRequest $request)
    {
        $billParticular = BillParticular::create($request->all());

        return (new BillParticularResource($billParticular))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BillParticular $billParticular)
    {
        abort_if(Gate::denies('bill_particular_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BillParticularResource($billParticular->load(['from_area', 'created_by']));
    }

    public function update(UpdateBillParticularRequest $request, BillParticular $billParticular)
    {
        $billParticular->update($request->all());

        return (new BillParticularResource($billParticular))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BillParticular $billParticular)
    {
        abort_if(Gate::denies('bill_particular_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billParticular->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
