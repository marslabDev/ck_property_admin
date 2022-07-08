<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHouseStatusRequest;
use App\Http\Requests\StoreHouseStatusRequest;
use App\Http\Requests\UpdateHouseStatusRequest;
use App\Models\HouseStatus;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HouseStatusController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('house_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HouseStatus::with(['created_by'])->select(sprintf('%s.*', (new HouseStatus())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'house_status_show';
                $editGate = 'house_status_edit';
                $deleteGate = 'house_status_delete';
                $crudRoutePart = 'house-statuses';

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
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.houseStatuses.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('house_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.houseStatuses.create');
    }

    public function store(StoreHouseStatusRequest $request)
    {
        $houseStatus = HouseStatus::create($request->all());

        return redirect()->route('admin.house-statuses.index');
    }

    public function edit(HouseStatus $houseStatus)
    {
        abort_if(Gate::denies('house_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseStatus->load('created_by');

        return view('admin.houseStatuses.edit', compact('houseStatus'));
    }

    public function update(UpdateHouseStatusRequest $request, HouseStatus $houseStatus)
    {
        $houseStatus->update($request->all());

        return redirect()->route('admin.house-statuses.index');
    }

    public function show(HouseStatus $houseStatus)
    {
        abort_if(Gate::denies('house_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseStatus->load('created_by', 'houseStatusManageHouses');

        return view('admin.houseStatuses.show', compact('houseStatus'));
    }

    public function destroy(HouseStatus $houseStatus)
    {
        abort_if(Gate::denies('house_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $houseStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyHouseStatusRequest $request)
    {
        HouseStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
