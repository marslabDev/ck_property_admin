<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyNoticeRequest;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Models\Area;
use App\Models\Notice;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class NoticesController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('notice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notices = Notice::with(['create_by', 'people_in_role', 'people_in_area', 'media'])->get();

        return view('frontend.notices.index', compact('notices'));
    }

    public function create()
    {
        abort_if(Gate::denies('notice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $create_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $people_in_roles = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $people_in_areas = Area::pluck('address_line', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.notices.create', compact('create_bies', 'people_in_areas', 'people_in_roles'));
    }

    public function store(StoreNoticeRequest $request)
    {
        $notice = Notice::create($request->all());

        if ($request->input('image', false)) {
            $notice->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $notice->id]);
        }

        return redirect()->route('frontend.notices.index');
    }

    public function edit(Notice $notice)
    {
        abort_if(Gate::denies('notice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $create_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $people_in_roles = Role::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $people_in_areas = Area::pluck('address_line', 'id')->prepend(trans('global.pleaseSelect'), '');

        $notice->load('create_by', 'people_in_role', 'people_in_area');

        return view('frontend.notices.edit', compact('create_bies', 'notice', 'people_in_areas', 'people_in_roles'));
    }

    public function update(UpdateNoticeRequest $request, Notice $notice)
    {
        $notice->update($request->all());

        if ($request->input('image', false)) {
            if (!$notice->image || $request->input('image') !== $notice->image->file_name) {
                if ($notice->image) {
                    $notice->image->delete();
                }
                $notice->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($notice->image) {
            $notice->image->delete();
        }

        return redirect()->route('frontend.notices.index');
    }

    public function show(Notice $notice)
    {
        abort_if(Gate::denies('notice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notice->load('create_by', 'people_in_role', 'people_in_area');

        return view('frontend.notices.show', compact('notice'));
    }

    public function destroy(Notice $notice)
    {
        abort_if(Gate::denies('notice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $notice->delete();

        return back();
    }

    public function massDestroy(MassDestroyNoticeRequest $request)
    {
        Notice::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('notice_create') && Gate::denies('notice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Notice();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
