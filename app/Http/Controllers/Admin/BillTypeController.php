<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBillTypeRequest;
use App\Http\Requests\StoreBillTypeRequest;
use App\Http\Requests\UpdateBillTypeRequest;
use App\Models\Area;
use App\Models\BillType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BillTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bill_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BillType::with(['from_area', 'created_by'])->select(sprintf('%s.*', (new BillType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bill_type_show';
                $editGate = 'bill_type_edit';
                $deleteGate = 'bill_type_delete';
                $crudRoutePart = 'bill-types';

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
            $table->addColumn('from_area_name', function ($row) {
                return $row->from_area ? $row->from_area->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'from_area']);

            return $table->make(true);
        }

        $areas = Area::get();
        $users = User::get();

        return view('admin.billTypes.index', compact('areas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bill_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.billTypes.create');
    }

    public function store(StoreBillTypeRequest $request)
    {
        $billType = BillType::create($request->all());

        return redirect()->route('admin.bill-types.index');
    }

    public function edit(BillType $billType)
    {
        abort_if(Gate::denies('bill_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billType->load('from_area', 'created_by');

        return view('admin.billTypes.edit', compact('billType'));
    }

    public function update(UpdateBillTypeRequest $request, BillType $billType)
    {
        $billType->update($request->all());

        return redirect()->route('admin.bill-types.index');
    }

    public function show(BillType $billType)
    {
        abort_if(Gate::denies('bill_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billType->load('from_area', 'created_by');

        return view('admin.billTypes.show', compact('billType'));
    }

    public function destroy(BillType $billType)
    {
        abort_if(Gate::denies('bill_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billType->delete();

        return back();
    }

    public function massDestroy(MassDestroyBillTypeRequest $request)
    {
        BillType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
