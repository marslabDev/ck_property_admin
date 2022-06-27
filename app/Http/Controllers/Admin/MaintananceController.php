<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMaintananceRequest;
use App\Http\Requests\StoreMaintananceRequest;
use App\Http\Requests\UpdateMaintananceRequest;
use App\Models\Area;
use App\Models\Maintanance;
use App\Models\MaintananceType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MaintananceController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('maintanance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Maintanance::with(['type', 'area', 'handle_by', 'supplier', 'created_by'])->select(sprintf('%s.*', (new Maintanance())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'maintanance_show';
                $editGate = 'maintanance_edit';
                $deleteGate = 'maintanance_delete';
                $crudRoutePart = 'maintanances';

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
            $table->addColumn('type_title', function ($row) {
                return $row->type ? $row->type->title : '';
            });

            $table->addColumn('area_name', function ($row) {
                return $row->area ? $row->area->name : '';
            });

            $table->editColumn('area.address_line', function ($row) {
                return $row->area ? (is_string($row->area) ? $row->area : $row->area->address_line) : '';
            });
            $table->addColumn('handle_by_name', function ($row) {
                return $row->handle_by ? $row->handle_by->name : '';
            });

            $table->addColumn('supplier_name', function ($row) {
                return $row->supplier ? $row->supplier->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'type', 'area', 'handle_by', 'supplier']);

            return $table->make(true);
        }

        $maintanance_types = MaintananceType::get();
        $areas             = Area::get();
        $users             = User::get();

        return view('admin.maintanances.index', compact('maintanance_types', 'areas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('maintanance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = MaintananceType::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $handle_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suppliers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.maintanances.create', compact('areas', 'handle_bies', 'suppliers', 'types'));
    }

    public function store(StoreMaintananceRequest $request)
    {
        $maintanance = Maintanance::create($request->all());

        return redirect()->route('admin.maintanances.index');
    }

    public function edit(Maintanance $maintanance)
    {
        abort_if(Gate::denies('maintanance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = MaintananceType::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $handle_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $suppliers = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $maintanance->load('type', 'area', 'handle_by', 'supplier', 'created_by');

        return view('admin.maintanances.edit', compact('areas', 'handle_bies', 'maintanance', 'suppliers', 'types'));
    }

    public function update(UpdateMaintananceRequest $request, Maintanance $maintanance)
    {
        $maintanance->update($request->all());

        return redirect()->route('admin.maintanances.index');
    }

    public function show(Maintanance $maintanance)
    {
        abort_if(Gate::denies('maintanance_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintanance->load('type', 'area', 'handle_by', 'supplier', 'created_by');

        return view('admin.maintanances.show', compact('maintanance'));
    }

    public function destroy(Maintanance $maintanance)
    {
        abort_if(Gate::denies('maintanance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintanance->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaintananceRequest $request)
    {
        Maintanance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
