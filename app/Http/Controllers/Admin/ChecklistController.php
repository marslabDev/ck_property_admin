<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyChecklistRequest;
use App\Http\Requests\StoreChecklistRequest;
use App\Http\Requests\UpdateChecklistRequest;
use App\Models\Checklist;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ChecklistController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('checklist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Checklist::with(['supplier', 'project', 'created_by'])->select(sprintf('%s.*', (new Checklist())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'checklist_show';
                $editGate = 'checklist_edit';
                $deleteGate = 'checklist_delete';
                $crudRoutePart = 'checklists';

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
            $table->addColumn('supplier_company', function ($row) {
                return $row->supplier ? $row->supplier->company : '';
            });

            $table->addColumn('project_name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? Checklist::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'supplier', 'project']);

            return $table->make(true);
        }

        $clients  = Client::get();
        $projects = Project::get();
        $users    = User::get();

        return view('admin.checklists.index', compact('clients', 'projects', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('checklist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suppliers = Client::pluck('company', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = Project::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.checklists.create', compact('projects', 'suppliers'));
    }

    public function store(StoreChecklistRequest $request)
    {
        $checklist = Checklist::create($request->all());

        return redirect()->route('admin.checklists.index');
    }

    public function edit(Checklist $checklist)
    {
        abort_if(Gate::denies('checklist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suppliers = Client::pluck('company', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = Project::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $checklist->load('supplier', 'project', 'created_by');

        return view('admin.checklists.edit', compact('checklist', 'projects', 'suppliers'));
    }

    public function update(UpdateChecklistRequest $request, Checklist $checklist)
    {
        $checklist->update($request->all());

        return redirect()->route('admin.checklists.index');
    }

    public function show(Checklist $checklist)
    {
        abort_if(Gate::denies('checklist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checklist->load('supplier', 'project', 'created_by');

        return view('admin.checklists.show', compact('checklist'));
    }

    public function destroy(Checklist $checklist)
    {
        abort_if(Gate::denies('checklist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checklist->delete();

        return back();
    }

    public function massDestroy(MassDestroyChecklistRequest $request)
    {
        Checklist::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
