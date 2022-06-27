<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyClientStatusRequest;
use App\Http\Requests\StoreClientStatusRequest;
use App\Http\Requests\UpdateClientStatusRequest;
use App\Models\ClientStatus;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientStatusController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('client_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClientStatus::with(['created_by'])->select(sprintf('%s.*', (new ClientStatus())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'client_status_show';
                $editGate = 'client_status_edit';
                $deleteGate = 'client_status_delete';
                $crudRoutePart = 'client-statuses';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.clientStatuses.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('client_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.clientStatuses.create');
    }

    public function store(StoreClientStatusRequest $request)
    {
        $clientStatus = ClientStatus::create($request->all());

        return redirect()->route('admin.client-statuses.index');
    }

    public function edit(ClientStatus $clientStatus)
    {
        abort_if(Gate::denies('client_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientStatus->load('created_by');

        return view('admin.clientStatuses.edit', compact('clientStatus'));
    }

    public function update(UpdateClientStatusRequest $request, ClientStatus $clientStatus)
    {
        $clientStatus->update($request->all());

        return redirect()->route('admin.client-statuses.index');
    }

    public function show(ClientStatus $clientStatus)
    {
        abort_if(Gate::denies('client_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientStatus->load('created_by');

        return view('admin.clientStatuses.show', compact('clientStatus'));
    }

    public function destroy(ClientStatus $clientStatus)
    {
        abort_if(Gate::denies('client_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientStatusRequest $request)
    {
        ClientStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
