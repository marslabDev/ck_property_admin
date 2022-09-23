<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBillRequest;
use App\Http\Requests\StoreBillRequest;
use App\Http\Requests\UpdateBillRequest;
use App\Models\Area;
use App\Models\Bill;
use App\Models\BillCharge;
use App\Models\BillItem;
use App\Models\BillStatus;
use App\Models\ManageHouse;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BillController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bill_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Bill::with(['house', 'homeowner', 'bill_items', 'bill_charges', 'bill_status', 'from_area', 'created_by'])->select(sprintf('%s.*', (new Bill())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bill_show';
                $editGate = 'bill_edit';
                $deleteGate = 'bill_delete';
                $crudRoutePart = 'bills';

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
            $table->editColumn('billplz', function ($row) {
                return $row->billplz ? $row->billplz : '';
            });
            $table->editColumn('billplz_url', function ($row) {
                return $row->billplz_url ? $row->billplz_url : '';
            });
            $table->addColumn('house_unit_no', function ($row) {
                return $row->house ? $row->house->unit_no : '';
            });

            $table->addColumn('homeowner_name', function ($row) {
                return $row->homeowner ? $row->homeowner->name : '';
            });

            $table->editColumn('homeowner.email', function ($row) {
                return $row->homeowner ? (is_string($row->homeowner) ? $row->homeowner : $row->homeowner->email) : '';
            });

            $table->editColumn('bill_item', function ($row) {
                $labels = [];
                foreach ($row->bill_items as $bill_item) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $bill_item->total_unit);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('bill_charges', function ($row) {
                $labels = [];
                foreach ($row->bill_charges as $bill_charge) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $bill_charge->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->addColumn('bill_status_name', function ($row) {
                return $row->bill_status ? $row->bill_status->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'house', 'homeowner', 'bill_item', 'bill_charges', 'bill_status']);

            return $table->make(true);
        }

        $manage_houses = ManageHouse::get();
        $users         = User::get();
        $bill_items    = BillItem::get();
        $bill_charges  = BillCharge::get();
        $bill_statuses = BillStatus::get();
        $areas         = Area::get();

        return view('admin.bills.index', compact('manage_houses', 'users', 'bill_items', 'bill_charges', 'bill_statuses', 'areas'));
    }

    public function create()
    {
        abort_if(Gate::denies('bill_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houses = ManageHouse::pluck('unit_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $homeowners = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bill_items = BillItem::pluck('total_unit', 'id');

        $bill_charges = BillCharge::pluck('name', 'id');

        $bill_statuses = BillStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bills.create', compact('bill_charges', 'bill_items', 'bill_statuses', 'homeowners', 'houses'));
    }

    public function store(StoreBillRequest $request)
    {
        $bill = Bill::create($request->all());
        $bill->bill_items()->sync($request->input('bill_items', []));
        $bill->bill_charges()->sync($request->input('bill_charges', []));

        return redirect()->route('admin.bills.index');
    }

    public function edit(Bill $bill)
    {
        abort_if(Gate::denies('bill_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houses = ManageHouse::pluck('unit_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $homeowners = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bill_items = BillItem::pluck('total_unit', 'id');

        $bill_charges = BillCharge::pluck('name', 'id');

        $bill_statuses = BillStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bill->load('house', 'homeowner', 'bill_items', 'bill_charges', 'bill_status', 'from_area', 'created_by');

        return view('admin.bills.edit', compact('bill', 'bill_charges', 'bill_items', 'bill_statuses', 'homeowners', 'houses'));
    }

    public function update(UpdateBillRequest $request, Bill $bill)
    {
        $bill->update($request->all());
        $bill->bill_items()->sync($request->input('bill_items', []));
        $bill->bill_charges()->sync($request->input('bill_charges', []));

        return redirect()->route('admin.bills.index');
    }

    public function show(Bill $bill)
    {
        abort_if(Gate::denies('bill_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill->load('house', 'homeowner', 'bill_items', 'bill_charges', 'bill_status', 'from_area', 'created_by', 'billBillHistories', 'billBillItems');

        return view('admin.bills.show', compact('bill'));
    }

    public function destroy(Bill $bill)
    {
        abort_if(Gate::denies('bill_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bill->delete();

        return back();
    }

    public function massDestroy(MassDestroyBillRequest $request)
    {
        Bill::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
