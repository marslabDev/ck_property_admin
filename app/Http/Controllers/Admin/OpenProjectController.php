<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOpenProjectRequest;
use App\Http\Requests\StoreOpenProjectRequest;
use App\Http\Requests\UpdateOpenProjectRequest;
use App\Models\Area;
use App\Models\Client;
use App\Models\OpenProject;
use App\Models\ProjectStatus;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OpenProjectController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('open_project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OpenProject::with(['areas', 'suppliers', 'status', 'created_by'])->select(sprintf('%s.*', (new OpenProject())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'open_project_show';
                $editGate = 'open_project_edit';
                $deleteGate = 'open_project_delete';
                $crudRoutePart = 'open-projects';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('area', function ($row) {
                $labels = [];
                foreach ($row->areas as $area) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $area->name);
                }

                return implode(' ', $labels);
            });

            $table->editColumn('budget', function ($row) {
                return $row->budget ? $row->budget : '';
            });
            $table->editColumn('supplier', function ($row) {
                $labels = [];
                foreach ($row->suppliers as $supplier) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $supplier->company);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'area', 'supplier', 'status']);

            return $table->make(true);
        }

        $areas            = Area::get();
        $clients          = Client::get();
        $project_statuses = ProjectStatus::get();
        $users            = User::get();

        return view('admin.openProjects.index', compact('areas', 'clients', 'project_statuses', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('open_project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id');

        $suppliers = Client::pluck('company', 'id');

        $statuses = ProjectStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.openProjects.create', compact('areas', 'statuses', 'suppliers'));
    }

    public function store(StoreOpenProjectRequest $request)
    {
        $openProject = OpenProject::create($request->all());
        $openProject->areas()->sync($request->input('areas', []));
        $openProject->suppliers()->sync($request->input('suppliers', []));

        return redirect()->route('admin.open-projects.index');
    }

    public function edit(OpenProject $openProject)
    {
        abort_if(Gate::denies('open_project_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id');

        $suppliers = Client::pluck('company', 'id');

        $statuses = ProjectStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $openProject->load('areas', 'suppliers', 'status', 'created_by');

        return view('admin.openProjects.edit', compact('areas', 'openProject', 'statuses', 'suppliers'));
    }

    public function update(UpdateOpenProjectRequest $request, OpenProject $openProject)
    {
        $openProject->update($request->all());
        $openProject->areas()->sync($request->input('areas', []));
        $openProject->suppliers()->sync($request->input('suppliers', []));

        return redirect()->route('admin.open-projects.index');
    }

    public function show(OpenProject $openProject)
    {
        abort_if(Gate::denies('open_project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $openProject->load('areas', 'suppliers', 'status', 'created_by');

        return view('admin.openProjects.show', compact('openProject'));
    }

    public function destroy(OpenProject $openProject)
    {
        abort_if(Gate::denies('open_project_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $openProject->delete();

        return back();
    }

    public function massDestroy(MassDestroyOpenProjectRequest $request)
    {
        OpenProject::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
