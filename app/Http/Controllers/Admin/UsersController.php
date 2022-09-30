<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Area;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::with(['roles', 'areas'])->select(sprintf('%s.*', (new User())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'users';

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
            $table->editColumn('username', function ($row) {
                return $row->username ? $row->username : '';
            });
            $table->editColumn('phone_no', function ($row) {
                return $row->phone_no ? $row->phone_no : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('area', function ($row) {
                $labels = [];
                foreach ($row->areas as $area) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $area->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('two_factor', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->two_factor ? 'checked' : null) . '>';
            });
            $table->editColumn('approved', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->approved ? 'checked' : null) . '>';
            });
            $table->editColumn('verified', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->verified ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'roles', 'area', 'two_factor', 'approved', 'verified']);

            return $table->make(true);
        }

        $roles = Role::get();
        $areas = Area::get();

        return view('admin.users.index', compact('roles', 'areas'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $areas = Area::pluck('name', 'id');

        return view('admin.users.create', compact('areas', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->areas()->sync($request->input('areas', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $areas = Area::pluck('name', 'id');

        $user->load('roles', 'areas');

        return view('admin.users.edit', compact('areas', 'roles', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->areas()->sync($request->input('areas', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'areas', 'createdByMyCases', 'userUserDetails', 'userUserCardMgmts', 'userPaymentPlans', 'userHomeOwnerTransactions', 'createdByHomeOwnerTransactions', 'contactPersonManageHouses', 'contactPerson2ManageHouses', 'handleByMyCases', 'reportToMyCases', 'homeownerBills', 'paidByBillHistories', 'userUserAlerts', 'ownedByManageHouses');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
