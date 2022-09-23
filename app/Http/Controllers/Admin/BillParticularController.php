<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class BillParticularController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bill_particular_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BillParticular::with(['from_area', 'created_by'])->select(sprintf('%s.*', (new BillParticular())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bill_particular_show';
                $editGate = 'bill_particular_edit';
                $deleteGate = 'bill_particular_delete';
                $crudRoutePart = 'bill-particulars';

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
            $table->editColumn('unit_price', function ($row) {
                return $row->unit_price ? $row->unit_price : '';
            });
            $table->editColumn('uom', function ($row) {
                return $row->uom ? $row->uom : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $areas = Area::get();
        $users = User::get();

        return view('admin.billParticulars.index', compact('areas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bill_particular_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.billParticulars.create');
    }

    public function store(StoreBillParticularRequest $request)
    {
        $billParticular = BillParticular::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $billParticular->id]);
        }

        return redirect()->route('admin.bill-particulars.index');
    }

    public function edit(BillParticular $billParticular)
    {
        abort_if(Gate::denies('bill_particular_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billParticular->load('from_area', 'created_by');

        return view('admin.billParticulars.edit', compact('billParticular'));
    }

    public function update(UpdateBillParticularRequest $request, BillParticular $billParticular)
    {
        $billParticular->update($request->all());

        return redirect()->route('admin.bill-particulars.index');
    }

    public function show(BillParticular $billParticular)
    {
        abort_if(Gate::denies('bill_particular_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billParticular->load('from_area', 'created_by', 'billParticularBillItems');

        return view('admin.billParticulars.show', compact('billParticular'));
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
