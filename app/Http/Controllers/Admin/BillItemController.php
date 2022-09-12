<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBillItemRequest;
use App\Http\Requests\StoreBillItemRequest;
use App\Http\Requests\UpdateBillItemRequest;
use App\Models\Area;
use App\Models\BillItem;
use App\Models\BillParticular;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BillItemController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bill_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BillItem::with(['bill_particular', 'from_area', 'created_by'])->select(sprintf('%s.*', (new BillItem())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bill_item_show';
                $editGate = 'bill_item_edit';
                $deleteGate = 'bill_item_delete';
                $crudRoutePart = 'bill-items';

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
            $table->addColumn('bill_particular_name', function ($row) {
                return $row->bill_particular ? $row->bill_particular->name : '';
            });

            $table->editColumn('total_unit', function ($row) {
                return $row->total_unit ? $row->total_unit : '';
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'bill_particular']);

            return $table->make(true);
        }

        $bill_particulars = BillParticular::get();
        $areas            = Area::get();
        $users            = User::get();

        return view('admin.billItems.index', compact('bill_particulars', 'areas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bill_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill_particulars = BillParticular::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.billItems.create', compact('bill_particulars'));
    }

    public function store(StoreBillItemRequest $request)
    {
        $billItem = BillItem::create($request->all());

        return redirect()->route('admin.bill-items.index');
    }

    public function edit(BillItem $billItem)
    {
        abort_if(Gate::denies('bill_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill_particulars = BillParticular::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $billItem->load('bill_particular', 'from_area', 'created_by');

        return view('admin.billItems.edit', compact('billItem', 'bill_particulars'));
    }

    public function update(UpdateBillItemRequest $request, BillItem $billItem)
    {
        $billItem->update($request->all());

        return redirect()->route('admin.bill-items.index');
    }

    public function show(BillItem $billItem)
    {
        abort_if(Gate::denies('bill_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billItem->load('bill_particular', 'from_area', 'created_by', 'billItemBills');

        return view('admin.billItems.show', compact('billItem'));
    }

    public function destroy(BillItem $billItem)
    {
        abort_if(Gate::denies('bill_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyBillItemRequest $request)
    {
        BillItem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
