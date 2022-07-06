<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStreetRequest;
use App\Http\Requests\StoreStreetRequest;
use App\Http\Requests\UpdateStreetRequest;
use App\Models\Area;
use App\Models\Street;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StreetController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('street_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Street::with(['area', 'created_by'])->select(sprintf('%s.*', (new Street())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'street_show';
                $editGate = 'street_edit';
                $deleteGate = 'street_delete';
                $crudRoutePart = 'streets';

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
            $table->editColumn('street_name', function ($row) {
                return $row->street_name ? $row->street_name : '';
            });
            $table->addColumn('area_name', function ($row) {
                return $row->area ? $row->area->name : '';
            });

            $table->editColumn('area.city', function ($row) {
                return $row->area ? (is_string($row->area) ? $row->area : $row->area->city) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'area']);

            return $table->make(true);
        }

        $areas = Area::get();
        $users = User::get();

        return view('admin.streets.index', compact('areas', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('street_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.streets.create', compact('areas'));
    }

    public function store(StoreStreetRequest $request)
    {
        $street = Street::create($request->all());

        return redirect()->route('admin.streets.index');
    }

    public function edit(Street $street)
    {
        abort_if(Gate::denies('street_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $street->load('area', 'created_by');

        return view('admin.streets.edit', compact('areas', 'street'));
    }

    public function update(UpdateStreetRequest $request, Street $street)
    {
        $street->update($request->all());

        return redirect()->route('admin.streets.index');
    }

    public function show(Street $street)
    {
        abort_if(Gate::denies('street_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $street->load('area', 'created_by', 'streetManageHouses');

        return view('admin.streets.show', compact('street'));
    }

    public function destroy(Street $street)
    {
        abort_if(Gate::denies('street_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $street->delete();

        return back();
    }

    public function massDestroy(MassDestroyStreetRequest $request)
    {
        Street::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
