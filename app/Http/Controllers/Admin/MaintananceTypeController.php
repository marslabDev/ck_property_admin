<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMaintananceTypeRequest;
use App\Http\Requests\StoreMaintananceTypeRequest;
use App\Http\Requests\UpdateMaintananceTypeRequest;
use App\Models\MaintananceType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MaintananceTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('maintanance_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MaintananceType::with(['created_by'])->select(sprintf('%s.*', (new MaintananceType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'maintanance_type_show';
                $editGate = 'maintanance_type_edit';
                $deleteGate = 'maintanance_type_delete';
                $crudRoutePart = 'maintanance-types';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.maintananceTypes.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('maintanance_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.maintananceTypes.create');
    }

    public function store(StoreMaintananceTypeRequest $request)
    {
        $maintananceType = MaintananceType::create($request->all());

        return redirect()->route('admin.maintanance-types.index');
    }

    public function edit(MaintananceType $maintananceType)
    {
        abort_if(Gate::denies('maintanance_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintananceType->load('created_by');

        return view('admin.maintananceTypes.edit', compact('maintananceType'));
    }

    public function update(UpdateMaintananceTypeRequest $request, MaintananceType $maintananceType)
    {
        $maintananceType->update($request->all());

        return redirect()->route('admin.maintanance-types.index');
    }

    public function show(MaintananceType $maintananceType)
    {
        abort_if(Gate::denies('maintanance_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintananceType->load('created_by');

        return view('admin.maintananceTypes.show', compact('maintananceType'));
    }

    public function destroy(MaintananceType $maintananceType)
    {
        abort_if(Gate::denies('maintanance_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintananceType->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaintananceTypeRequest $request)
    {
        MaintananceType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
