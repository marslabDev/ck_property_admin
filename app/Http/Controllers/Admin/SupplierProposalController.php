<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class SupplierProposalController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('supplier_proposal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SupplierProposal::with(['open_project', 'created_by'])->select(sprintf('%s.*', (new SupplierProposal())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'supplier_proposal_show';
                $editGate = 'supplier_proposal_edit';
                $deleteGate = 'supplier_proposal_delete';
                $crudRoutePart = 'supplier-proposals';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('representative_name', function ($row) {
                return $row->representative_name ? $row->representative_name : '';
            });
            $table->editColumn('contact_no', function ($row) {
                return $row->contact_no ? $row->contact_no : '';
            });
            $table->editColumn('documents', function ($row) {
                if (!$row->documents) {
                    return '';
                }
                $links = [];
                foreach ($row->documents as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->addColumn('open_project_name', function ($row) {
                return $row->open_project ? $row->open_project->name : '';
            });

            $table->editColumn('open_project.description', function ($row) {
                return $row->open_project ? (is_string($row->open_project) ? $row->open_project : $row->open_project->description) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'documents', 'open_project']);

            return $table->make(true);
        }

        $open_projects = OpenProject::get();
        $users         = User::get();

        return view('admin.supplierProposals.index', compact('open_projects', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('supplier_proposal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $open_projects = OpenProject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.supplierProposals.create', compact('open_projects'));
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

        return redirect()->route('admin.supplier-proposals.index');
    }

    public function edit(SupplierProposal $supplierProposal)
    {
        abort_if(Gate::denies('supplier_proposal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $open_projects = OpenProject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $supplierProposal->load('open_project', 'created_by');

        return view('admin.supplierProposals.edit', compact('open_projects', 'supplierProposal'));
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

        return redirect()->route('admin.supplier-proposals.index');
    }

    public function show(SupplierProposal $supplierProposal)
    {
        abort_if(Gate::denies('supplier_proposal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supplierProposal->load('open_project', 'created_by');

        return view('admin.supplierProposals.show', compact('supplierProposal'));
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
