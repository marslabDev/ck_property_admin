<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMyCaseRequest;
use App\Http\Requests\StoreMyCaseRequest;
use App\Http\Requests\UpdateMyCaseRequest;
use App\Models\CasesCategory;
use App\Models\MyCase;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MyCasesController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('my_case_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myCases = MyCase::with(['category', 'report_by', 'handle_by', 'created_by', 'media'])->get();

        $cases_categories = CasesCategory::get();

        $users = User::get();

        return view('frontend.myCases.index', compact('cases_categories', 'myCases', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('my_case_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = CasesCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $report_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $handle_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.myCases.create', compact('categories', 'handle_bies', 'report_bies'));
    }

    public function store(StoreMyCaseRequest $request)
    {
        $myCase = MyCase::create($request->all());

        if ($request->input('image', false)) {
            $myCase->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $myCase->id]);
        }

        return redirect()->route('frontend.my-cases.index');
    }

    public function edit(MyCase $myCase)
    {
        abort_if(Gate::denies('my_case_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = CasesCategory::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $report_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $handle_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $myCase->load('category', 'report_by', 'handle_by', 'created_by');

        return view('frontend.myCases.edit', compact('categories', 'handle_bies', 'myCase', 'report_bies'));
    }

    public function update(UpdateMyCaseRequest $request, MyCase $myCase)
    {
        $myCase->update($request->all());

        if ($request->input('image', false)) {
            if (!$myCase->image || $request->input('image') !== $myCase->image->file_name) {
                if ($myCase->image) {
                    $myCase->image->delete();
                }
                $myCase->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($myCase->image) {
            $myCase->image->delete();
        }

        return redirect()->route('frontend.my-cases.index');
    }

    public function show(MyCase $myCase)
    {
        abort_if(Gate::denies('my_case_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myCase->load('category', 'report_by', 'handle_by', 'created_by');

        return view('frontend.myCases.show', compact('myCase'));
    }

    public function destroy(MyCase $myCase)
    {
        abort_if(Gate::denies('my_case_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myCase->delete();

        return back();
    }

    public function massDestroy(MassDestroyMyCaseRequest $request)
    {
        MyCase::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('my_case_create') && Gate::denies('my_case_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MyCase();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
