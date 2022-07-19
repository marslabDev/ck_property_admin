<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySupplierProposalRequest;
use App\Http\Requests\StoreSupplierProposalRequest;
use App\Http\Requests\UpdateSupplierProposalRequest;
use App\Models\OpenProject;
use App\Models\SupplierProposal;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SupplierProposalController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('supplier_proposal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplierProposals = SupplierProposal::with(['open_project', 'created_by', 'media'])->get();

        $open_projects = OpenProject::get();

        $users = User::get();

        return view('frontend.supplierProposals.index', compact('open_projects', 'supplierProposals', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('supplier_proposal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $open_projects = OpenProject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.supplierProposals.create', compact('open_projects'));
    }

    public function store(StoreSupplierProposalRequest $request)
    {
        $supplierProposal = SupplierProposal::create($request->all());

        foreach ($request->input('documents', []) as $file) {
            $supplierProposal->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('documents');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $supplierProposal->id]);
        }

        return redirect()->route('frontend.supplier-proposals.index');
    }

    public function edit(SupplierProposal $supplierProposal)
    {
        abort_if(Gate::denies('supplier_proposal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $open_projects = OpenProject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $supplierProposal->load('open_project', 'created_by');

        return view('frontend.supplierProposals.edit', compact('open_projects', 'supplierProposal'));
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

        return redirect()->route('frontend.supplier-proposals.index');
    }

    public function show(SupplierProposal $supplierProposal)
    {
        abort_if(Gate::denies('supplier_proposal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplierProposal->load('open_project', 'created_by');

        return view('frontend.supplierProposals.show', compact('supplierProposal'));
    }

    public function destroy(SupplierProposal $supplierProposal)
    {
        abort_if(Gate::denies('supplier_proposal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplierProposal->delete();

        return back();
    }

    public function massDestroy(MassDestroySupplierProposalRequest $request)
    {
        SupplierProposal::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('supplier_proposal_create') && Gate::denies('supplier_proposal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SupplierProposal();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
