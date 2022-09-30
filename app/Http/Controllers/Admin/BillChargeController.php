<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBillChargeRequest;
use App\Http\Requests\StoreBillChargeRequest;
use App\Http\Requests\UpdateBillChargeRequest;
use App\Models\Area;
use App\Models\BillCharge;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BillChargeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bill_charge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BillCharge::with(['from_area', 'created_by'])->select(sprintf('%s.*', (new BillCharge())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bill_charge_show';
                $editGate = 'bill_charge_edit';
                $deleteGate = 'bill_charge_delete';
                $crudRoutePart = 'bill-charges';

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
            $table->editColumn('type', function ($row) {
                return $row->type ? BillCharge::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('rate', function ($row) {
                return $row->rate ? $row->rate : '';
            });
            $table->addColumn('from_area_name', function ($row) {
                return $row->from_area ? $row->from_area->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'from_area']);

            return $table->make(true);
        }

        $areas = Area::get();
        $users = User::get();

        return view('admin.billCharges.index', compact('areas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bill_charge_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.billCharges.create');
    }

    public function store(StoreBillChargeRequest $request)
    {
        $billCharge = BillCharge::create($request->all());

        return redirect()->route('admin.bill-charges.index');
    }

    public function edit(BillCharge $billCharge)
    {
        abort_if(Gate::denies('bill_charge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billCharge->load('from_area', 'created_by');

        return view('admin.billCharges.edit', compact('billCharge'));
    }

    public function update(UpdateBillChargeRequest $request, BillCharge $billCharge)
    {
        $billCharge->update($request->all());

        return redirect()->route('admin.bill-charges.index');
    }

    public function show(BillCharge $billCharge)
    {
        abort_if(Gate::denies('bill_charge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billCharge->load('from_area', 'created_by', 'billChargesBills');

        return view('admin.billCharges.show', compact('billCharge'));
    }

    public function destroy(BillCharge $billCharge)
    {
        abort_if(Gate::denies('bill_charge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billCharge->delete();

        return back();
    }

    public function massDestroy(MassDestroyBillChargeRequest $request)
    {
        BillCharge::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
