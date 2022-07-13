<?php

namespace App\Http\Controllers\Frontend;

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

class ChecklistController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('checklist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checklists = Checklist::with(['supplier', 'project', 'created_by'])->get();

        $clients = Client::get();

        $projects = Project::get();

        $users = User::get();

        return view('frontend.checklists.index', compact('checklists', 'clients', 'projects', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('checklist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suppliers = Client::pluck('company', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = Project::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.checklists.create', compact('projects', 'suppliers'));
    }

    public function store(StoreChecklistRequest $request)
    {
        $checklist = Checklist::create($request->all());

        return redirect()->route('frontend.checklists.index');
    }

    public function edit(Checklist $checklist)
    {
        abort_if(Gate::denies('checklist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suppliers = Client::pluck('company', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = Project::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $checklist->load('supplier', 'project', 'created_by');

        return view('frontend.checklists.edit', compact('checklist', 'projects', 'suppliers'));
    }

    public function update(UpdateChecklistRequest $request, Checklist $checklist)
    {
        $checklist->update($request->all());

        return redirect()->route('frontend.checklists.index');
    }

    public function show(Checklist $checklist)
    {
        abort_if(Gate::denies('checklist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checklist->load('supplier', 'project', 'created_by');

        return view('frontend.checklists.show', compact('checklist'));
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
