<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class OpenProjectController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('open_project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = OpenProject::with(['areas', 'created_by'])->select(sprintf('%s.*', (new OpenProject())->table));
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
            $table->editColumn('area', function ($row) {
                $labels = [];
                foreach ($row->areas as $area) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $area->name);
                }

                return implode(' ', $labels);
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? OpenProject::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'documents', 'area']);

            return $table->make(true);
        }

        $areas = Area::get();
        $users = User::get();

        return view('admin.openProjects.index', compact('areas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('open_project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id');

        return view('admin.openProjects.create', compact('areas'));
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

        return redirect()->route('admin.open-projects.index');
    }

    public function edit(OpenProject $openProject)
    {
        abort_if(Gate::denies('open_project_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id');

        $openProject->load('areas', 'created_by');

        return view('admin.openProjects.edit', compact('areas', 'openProject'));
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

        return redirect()->route('admin.open-projects.index');
    }

    public function show(OpenProject $openProject)
    {
        abort_if(Gate::denies('open_project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $openProject->load('areas', 'created_by', 'openProjectSupplierProposals');

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
