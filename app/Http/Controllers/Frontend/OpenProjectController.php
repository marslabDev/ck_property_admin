<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyOpenProjectRequest;
use App\Http\Requests\StoreOpenProjectRequest;
use App\Http\Requests\UpdateOpenProjectRequest;
use App\Models\Area;
use App\Models\OpenProject;
use App\Models\ProjectStatus;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OpenProjectController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('open_project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $openProjects = OpenProject::with(['areas', 'status', 'created_by'])->get();

        $areas = Area::get();

        $project_statuses = ProjectStatus::get();

        $users = User::get();

        return view('frontend.openProjects.index', compact('areas', 'openProjects', 'project_statuses', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('open_project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id');

        $statuses = ProjectStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.openProjects.create', compact('areas', 'statuses'));
    }

    public function store(StoreOpenProjectRequest $request)
    {
        $openProject = OpenProject::create($request->all());
        $openProject->areas()->sync($request->input('areas', []));

        return redirect()->route('frontend.open-projects.index');
    }

    public function edit(OpenProject $openProject)
    {
        abort_if(Gate::denies('open_project_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id');

        $statuses = ProjectStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $openProject->load('areas', 'status', 'created_by');

        return view('frontend.openProjects.edit', compact('areas', 'openProject', 'statuses'));
    }

    public function update(UpdateOpenProjectRequest $request, OpenProject $openProject)
    {
        $openProject->update($request->all());
        $openProject->areas()->sync($request->input('areas', []));

        return redirect()->route('frontend.open-projects.index');
    }

    public function show(OpenProject $openProject)
    {
        abort_if(Gate::denies('open_project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $openProject->load('areas', 'status', 'created_by', 'openProjectSupplierProposals');

        return view('frontend.openProjects.show', compact('openProject'));
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
