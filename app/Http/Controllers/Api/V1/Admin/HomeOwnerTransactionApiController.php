<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeOwnerTransactionRequest;
use App\Http\Requests\UpdateHomeOwnerTransactionRequest;
use App\Http\Resources\Admin\HomeOwnerTransactionResource;
use App\Models\HomeOwnerTransaction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeOwnerTransactionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('home_owner_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HomeOwnerTransactionResource(HomeOwnerTransaction::with(['user', 'house', 'payment_plan', 'payment_type', 'created_by'])->get());
    }

    public function store(StoreHomeOwnerTransactionRequest $request)
    {
        $homeOwnerTransaction = HomeOwnerTransaction::create($request->all());

        return (new HomeOwnerTransactionResource($homeOwnerTransaction))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(HomeOwnerTransaction $homeOwnerTransaction)
    {
        abort_if(Gate::denies('home_owner_transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HomeOwnerTransactionResource($homeOwnerTransaction->load(['user', 'house', 'payment_plan', 'payment_type', 'created_by']));
    }

    public function update(UpdateHomeOwnerTransactionRequest $request, HomeOwnerTransaction $homeOwnerTransaction)
    {
        $homeOwnerTransaction->update($request->all());

        return (new HomeOwnerTransactionResource($homeOwnerTransaction))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(HomeOwnerTransaction $homeOwnerTransaction)
    {
        abort_if(Gate::denies('home_owner_transaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homeOwnerTransaction->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
