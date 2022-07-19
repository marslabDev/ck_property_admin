<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOpenProjectRequest;
use App\Http\Requests\StoreOpenProjectRequest;
use App\Http\Requests\UpdateOpenProjectRequest;
use App\Models\Area;
use App\Models\OpenProject;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class OpenProjectController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('open_project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $openProjects = OpenProject::with(['areas', 'created_by', 'media'])->get();

        $areas = Area::get();

        $users = User::get();

        return view('frontend.openProjects.index', compact('areas', 'openProjects', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('open_project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id');

        return view('frontend.openProjects.create', compact('areas'));
    }

    public function store(StoreOpenProjectRequest $request)
    {
        $openProject = OpenProject::create($request->all());
        $openProject->areas()->sync($request->input('areas', []));
        foreach ($request->input('documents', []) as $file) {
            $openProject->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('documents');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $openProject->id]);
        }

        return redirect()->route('frontend.open-projects.index');
    }

    public function edit(OpenProject $openProject)
    {
        abort_if(Gate::denies('open_project_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id');

        $openProject->load('areas', 'created_by');

        return view('frontend.openProjects.edit', compact('areas', 'openProject'));
    }

    public function update(UpdateOpenProjectRequest $request, OpenProject $openProject)
    {
        $openProject->update($request->all());
        $openProject->areas()->sync($request->input('areas', []));
        if (count($openProject->documents) > 0) {
            foreach ($openProject->documents as $media) {
                if (!in_array($media->file_name, $request->input('documents', []))) {
                    $media->delete();
                }
            }
        }
        $media = $openProject->documents->pluck('file_name')->toArray();
        foreach ($request->input('documents', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $openProject->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('documents');
            }
        }

        return redirect()->route('frontend.open-projects.index');
    }

    public function show(OpenProject $openProject)
    {
        abort_if(Gate::denies('open_project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $openProject->load('areas', 'created_by', 'openProjectSupplierProposals');

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

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('open_project_create') && Gate::denies('open_project_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new OpenProject();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
