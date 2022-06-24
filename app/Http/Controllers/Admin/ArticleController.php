<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyArticleRequest;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Area;
use App\Models\Article;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('article_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Article::with(['create_by', 'people_in_role', 'people_in_area'])->select(sprintf('%s.*', (new Article())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'article_show';
                $editGate = 'article_edit';
                $deleteGate = 'article_delete';
                $crudRoutePart = 'articles';

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
            $table->editColumn('title_name', function ($row) {
                return $row->title_name ? $row->title_name : '';
            });
            $table->editColumn('detail', function ($row) {
                return $row->detail ? $row->detail : '';
            });
            $table->addColumn('create_by_name', function ($row) {
                return $row->create_by ? $row->create_by->name : '';
            });

            $table->addColumn('people_in_role_title', function ($row) {
                return $row->people_in_role ? $row->people_in_role->title : '';
            });

            $table->addColumn('people_in_area_name', function ($row) {
                return $row->people_in_area ? $row->people_in_area->name : '';
            });

            $table->editColumn('people_in_area.address_line', function ($row) {
                return $row->people_in_area ? (is_string($row->people_in_area) ? $row->people_in_area : $row->people_in_area->address_line) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'create_by', 'people_in_role', 'people_in_area']);

            return $table->make(true);
        }

        return view('admin.articles.index');
    }

    public function create()
    {
        abort_if(Gate::denies('article_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $create_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $people_in_roles = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $people_in_areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.articles.create', compact('create_bies', 'people_in_areas', 'people_in_roles'));
    }

    public function store(StoreArticleRequest $request)
    {
        $article = Article::create($request->all());

        if ($request->input('image', false)) {
            $article->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $article->id]);
        }

        return redirect()->route('admin.articles.index');
    }

    public function edit(Article $article)
    {
        abort_if(Gate::denies('article_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $create_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $people_in_roles = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $people_in_areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $article->load('create_by', 'people_in_role', 'people_in_area');

        return view('admin.articles.edit', compact('article', 'create_bies', 'people_in_areas', 'people_in_roles'));
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->update($request->all());

        if ($request->input('image', false)) {
            if (!$article->image || $request->input('image') !== $article->image->file_name) {
                if ($article->image) {
                    $article->image->delete();
                }
                $article->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($article->image) {
            $article->image->delete();
        }

        return redirect()->route('admin.articles.index');
    }

    public function show(Article $article)
    {
        abort_if(Gate::denies('article_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $article->load('create_by', 'people_in_role', 'people_in_area');

        return view('admin.articles.show', compact('article'));
    }

    public function destroy(Article $article)
    {
        abort_if(Gate::denies('article_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $article->delete();

        return back();
    }

    public function massDestroy(MassDestroyArticleRequest $request)
    {
        Article::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('article_create') && Gate::denies('article_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Article();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
