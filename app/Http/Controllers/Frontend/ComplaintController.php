<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyComplaintRequest;
use App\Http\Requests\StoreComplaintRequest;
use App\Http\Requests\UpdateComplaintRequest;
use App\Models\Complaint;
use App\Models\ComplaintStatus;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ComplaintController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('complaint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaints = Complaint::with(['status', 'created_by', 'media'])->get();

        $complaint_statuses = ComplaintStatus::get();

        $users = User::get();

        return view('frontend.complaints.index', compact('complaint_statuses', 'complaints', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('complaint_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = ComplaintStatus::pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.complaints.create', compact('statuses'));
    }

    public function store(StoreComplaintRequest $request)
    {
        $complaint = Complaint::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $complaint->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $complaint->id]);
        }

        return redirect()->route('frontend.complaints.index');
    }

    public function edit(Complaint $complaint)
    {
        abort_if(Gate::denies('complaint_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = ComplaintStatus::pluck('status', 'id')->prepend(trans('global.pleaseSelect'), '');

        $complaint->load('status', 'created_by');

        return view('frontend.complaints.edit', compact('complaint', 'statuses'));
    }

    public function update(UpdateComplaintRequest $request, Complaint $complaint)
    {
        $complaint->update($request->all());

        if (count($complaint->image) > 0) {
            foreach ($complaint->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $complaint->image->pluck('file_name')->toArray();
        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $complaint->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
            }
        }

        return redirect()->route('frontend.complaints.index');
    }

    public function show(Complaint $complaint)
    {
        abort_if(Gate::denies('complaint_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaint->load('status', 'created_by', 'complaintMyCases');

        return view('frontend.complaints.show', compact('complaint'));
    }

    public function destroy(Complaint $complaint)
    {
        abort_if(Gate::denies('complaint_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $complaint->delete();

        return back();
    }

    public function massDestroy(MassDestroyComplaintRequest $request)
    {
        Complaint::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('complaint_create') && Gate::denies('complaint_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Complaint();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
