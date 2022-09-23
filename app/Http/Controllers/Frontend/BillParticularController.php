<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBillParticularRequest;
use App\Http\Requests\StoreBillParticularRequest;
use App\Http\Requests\UpdateBillParticularRequest;
use App\Models\Area;
use App\Models\BillParticular;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BillParticularController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bill_particular_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billParticulars = BillParticular::with(['from_area', 'created_by'])->get();

        $areas = Area::get();

        $users = User::get();

        return view('frontend.billParticulars.index', compact('areas', 'billParticulars', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bill_particular_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.billParticulars.create');
    }

    public function store(StoreBillParticularRequest $request)
    {
        $billParticular = BillParticular::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $billParticular->id]);
        }

        return redirect()->route('frontend.bill-particulars.index');
    }

    public function edit(BillParticular $billParticular)
    {
        abort_if(Gate::denies('bill_particular_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billParticular->load('from_area', 'created_by');

        return view('frontend.billParticulars.edit', compact('billParticular'));
    }

    public function update(UpdateBillParticularRequest $request, BillParticular $billParticular)
    {
        $billParticular->update($request->all());

        return redirect()->route('frontend.bill-particulars.index');
    }

    public function show(BillParticular $billParticular)
    {
        abort_if(Gate::denies('bill_particular_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billParticular->load('from_area', 'created_by', 'billParticularBillItems');

        return view('frontend.billParticulars.show', compact('billParticular'));
    }

    public function destroy(BillParticular $billParticular)
    {
        abort_if(Gate::denies('bill_particular_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billParticular->delete();

        return back();
    }

    public function massDestroy(MassDestroyBillParticularRequest $request)
    {
        BillParticular::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('bill_particular_create') && Gate::denies('bill_particular_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new BillParticular();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
