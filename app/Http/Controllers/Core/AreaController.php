<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAreaRequest;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Models\Area;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AreaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('area_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Area::with(['created_by'])->select(sprintf('%s.*', (new Area())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'area_show';
                $editGate = 'area_edit';
                $deleteGate = 'area_delete';
                $crudRoutePart = 'areas';

                return view('partials.core.datatablesActions', compact(
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
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->editColumn('postcode', function ($row) {
                return $row->postcode ? $row->postcode : '';
            });
            $table->editColumn('state', function ($row) {
                return $row->state ? $row->state : '';
            });
            $table->editColumn('country', function ($row) {
                return $row->country ? $row->country : '';
            });

            $table->editColumn('user', function ($row) {
                $labels = [];
                foreach ($row->areaUsers as $user) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $user->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        $users = User::get();

        return view('core.areas.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('area_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id');

        return view('core.areas.create', compact('users'));
    }

    public function store(StoreAreaRequest $request)
    {
        $area = Area::create($request->all());
        $area->areaUsers()->sync($request->input('users', []));

        return redirect()->route('core.areas.index');
    }

    public function edit(Area $area)
    {
        abort_if(Gate::denies('area_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id');

        $area->load('created_by');

        return view('core.areas.edit', compact('area', 'users'));
    }

    public function update(UpdateAreaRequest $request, Area $area)
    {
        $area->update($request->all());
        $area->areaUsers()->sync($request->input('users', []));

        return redirect()->route('core.areas.index');
    }

    public function show(Area $area)
    {
        abort_if(Gate::denies('area_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $area->load('created_by', 'peopleInAreaNotices', 'fromAreaMyCases', 'fromAreaComplaints', 'fromAreaParkingLots', 'fromAreaManageHouses', 'fromAreaHouseTypes', 'fromAreaStreets', 'fromAreaManagePrices', 'fromAreaHouseStatuses', 'fromAreaCaseStatuses', 'fromAreaCasesCategories', 'fromAreaComplaintStatuses', 'fromAreaClients', 'fromAreaProjects', 'fromAreaOpenProjects', 'fromAreaNotes', 'fromAreaTransactions', 'fromAreaDocuments', 'fromAreaTaskStatuses', 'fromAreaTaskTags', 'fromAreaTasks', 'fromAreaTransactionTypes', 'fromAreaClientStatuses', 'fromAreaPaymentItems', 'fromAreaPaymentCharges', 'fromAreaPaymentTypes', 'fromAreaHomeOwnerTransactions', 'areaProjects', 'areaOpenProjects', 'areaUsers');

        return view('core.areas.show', compact('area'));
    }

    public function destroy(Area $area)
    {
        abort_if(Gate::denies('area_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $area->delete();

        return back();
    }

    public function massDestroy(MassDestroyAreaRequest $request)
    {
        Area::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
