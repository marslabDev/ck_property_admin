<?php

namespace App\Http\Controllers\Frontend;

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

class BillTypeController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bill_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billTypes = BillType::with(['from_area', 'created_by'])->get();

        $areas = Area::get();

        $users = User::get();

        return view('frontend.billTypes.index', compact('areas', 'billTypes', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('bill_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.billTypes.create');
    }

    public function store(StoreBillTypeRequest $request)
    {
        $billType = BillType::create($request->all());

        return redirect()->route('frontend.bill-types.index');
    }

    public function edit(BillType $billType)
    {
        abort_if(Gate::denies('bill_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billType->load('from_area', 'created_by');

        return view('frontend.billTypes.edit', compact('billType'));
    }

    public function update(UpdateBillTypeRequest $request, BillType $billType)
    {
        $billType->update($request->all());

        return redirect()->route('frontend.bill-types.index');
    }

    public function show(BillType $billType)
    {
        abort_if(Gate::denies('bill_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $billType->load('from_area', 'created_by');

        return view('frontend.billTypes.show', compact('billType'));
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
