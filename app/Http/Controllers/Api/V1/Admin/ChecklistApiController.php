<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChecklistRequest;
use App\Http\Requests\UpdateChecklistRequest;
use App\Http\Resources\Admin\ChecklistResource;
use App\Models\Checklist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChecklistApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('checklist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChecklistResource(Checklist::with(['supplier', 'project', 'created_by'])->get());
    }

    public function store(StoreChecklistRequest $request)
    {
        $checklist = Checklist::create($request->all());

        return (new ChecklistResource($checklist))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Checklist $checklist)
    {
        abort_if(Gate::denies('checklist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ChecklistResource($checklist->load(['supplier', 'project', 'created_by']));
    }

    public function update(UpdateChecklistRequest $request, Checklist $checklist)
    {
        $checklist->update($request->all());

        return (new ChecklistResource($checklist))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Checklist $checklist)
    {
        abort_if(Gate::denies('checklist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $checklist->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
