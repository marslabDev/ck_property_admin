<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierTransactionRequest;
use App\Http\Requests\UpdateSupplierTransactionRequest;
use App\Http\Resources\Admin\SupplierTransactionResource;
use App\Models\SupplierTransaction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupplierTransactionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('supplier_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupplierTransactionResource(SupplierTransaction::with(['project', 'transaction_type', 'income_source', 'currency', 'created_by'])->get());
    }

    public function store(StoreSupplierTransactionRequest $request)
    {
        $supplierTransaction = SupplierTransaction::create($request->all());

        return (new SupplierTransactionResource($supplierTransaction))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SupplierTransaction $supplierTransaction)
    {
        abort_if(Gate::denies('supplier_transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupplierTransactionResource($supplierTransaction->load(['project', 'transaction_type', 'income_source', 'currency', 'created_by']));
    }

    public function update(UpdateSupplierTransactionRequest $request, SupplierTransaction $supplierTransaction)
    {
        $supplierTransaction->update($request->all());

        return (new SupplierTransactionResource($supplierTransaction))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SupplierTransaction $supplierTransaction)
    {
        abort_if(Gate::denies('supplier_transaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplierTransaction->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
