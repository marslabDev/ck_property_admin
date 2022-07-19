<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSupplierProposalRequest;
use App\Http\Requests\UpdateSupplierProposalRequest;
use App\Http\Resources\Admin\SupplierProposalResource;
use App\Models\SupplierProposal;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupplierProposalApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('supplier_proposal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupplierProposalResource(SupplierProposal::with(['open_project', 'created_by'])->get());
    }

    public function store(StoreSupplierProposalRequest $request)
    {
        $supplierProposal = SupplierProposal::create($request->all());

        foreach ($request->input('documents', []) as $file) {
            $supplierProposal->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('documents');
        }

        return (new SupplierProposalResource($supplierProposal))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SupplierProposal $supplierProposal)
    {
        abort_if(Gate::denies('supplier_proposal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupplierProposalResource($supplierProposal->load(['open_project', 'created_by']));
    }

    public function update(UpdateSupplierProposalRequest $request, SupplierProposal $supplierProposal)
    {
        $supplierProposal->update($request->all());

        if (count($supplierProposal->documents) > 0) {
            foreach ($supplierProposal->documents as $media) {
                if (!in_array($media->file_name, $request->input('documents', []))) {
                    $media->delete();
                }
            }
        }
        $media = $supplierProposal->documents->pluck('file_name')->toArray();
        foreach ($request->input('documents', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $supplierProposal->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('documents');
            }
        }

        return (new SupplierProposalResource($supplierProposal))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SupplierProposal $supplierProposal)
    {
        abort_if(Gate::denies('supplier_proposal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplierProposal->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
