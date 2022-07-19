<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOpenProjectRequest;
use App\Http\Requests\UpdateOpenProjectRequest;
use App\Http\Resources\Admin\OpenProjectResource;
use App\Models\OpenProject;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OpenProjectApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('open_project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OpenProjectResource(OpenProject::with(['areas', 'status', 'created_by'])->get());
    }

    public function store(StoreOpenProjectRequest $request)
    {
        $openProject = OpenProject::create($request->all());
        $openProject->areas()->sync($request->input('areas', []));

        return (new OpenProjectResource($openProject))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(OpenProject $openProject)
    {
        abort_if(Gate::denies('open_project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OpenProjectResource($openProject->load(['areas', 'status', 'created_by']));
    }

    public function update(UpdateOpenProjectRequest $request, OpenProject $openProject)
    {
        $openProject->update($request->all());
        $openProject->areas()->sync($request->input('areas', []));

        return (new OpenProjectResource($openProject))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(OpenProject $openProject)
    {
        abort_if(Gate::denies('open_project_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $openProject->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
