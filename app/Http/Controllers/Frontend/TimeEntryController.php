<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTimeEntryRequest;
use App\Http\Requests\StoreTimeEntryRequest;
use App\Http\Requests\UpdateTimeEntryRequest;
use App\Models\TimeEntry;
use App\Models\TimeProject;
use App\Models\TimeWorkType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TimeEntryController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('time_entry_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeEntries = TimeEntry::with(['work_type', 'project', 'created_by'])->get();

        $time_work_types = TimeWorkType::get();

        $time_projects = TimeProject::get();

        $users = User::get();

        return view('frontend.timeEntries.index', compact('timeEntries', 'time_projects', 'time_work_types', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('time_entry_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $work_types = TimeWorkType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = TimeProject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.timeEntries.create', compact('projects', 'work_types'));
    }

    public function store(StoreTimeEntryRequest $request)
    {
        $timeEntry = TimeEntry::create($request->all());

        return redirect()->route('frontend.time-entries.index');
    }

    public function edit(TimeEntry $timeEntry)
    {
        abort_if(Gate::denies('time_entry_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $work_types = TimeWorkType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $projects = TimeProject::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $timeEntry->load('work_type', 'project', 'created_by');

        return view('frontend.timeEntries.edit', compact('projects', 'timeEntry', 'work_types'));
    }

    public function update(UpdateTimeEntryRequest $request, TimeEntry $timeEntry)
    {
        $timeEntry->update($request->all());

        return redirect()->route('frontend.time-entries.index');
    }

    public function show(TimeEntry $timeEntry)
    {
        abort_if(Gate::denies('time_entry_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeEntry->load('work_type', 'project', 'created_by');

        return view('frontend.timeEntries.show', compact('timeEntry'));
    }

    public function destroy(TimeEntry $timeEntry)
    {
        abort_if(Gate::denies('time_entry_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $timeEntry->delete();

        return back();
    }

    public function massDestroy(MassDestroyTimeEntryRequest $request)
    {
        TimeEntry::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
