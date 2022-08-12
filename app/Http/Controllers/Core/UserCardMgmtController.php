<?php

namespace App\Http\Controllers\Core;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUserCardMgmtRequest;
use App\Http\Requests\StoreUserCardMgmtRequest;
use App\Http\Requests\UpdateUserCardMgmtRequest;
use App\Models\User;
use App\Models\UserCardMgmt;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserCardMgmtController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_card_mgmt_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserCardMgmt::with(['user', 'created_by'])->select(sprintf('%s.*', (new UserCardMgmt())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_card_mgmt_show';
                $editGate = 'user_card_mgmt_edit';
                $deleteGate = 'user_card_mgmt_delete';
                $crudRoutePart = 'user-card-mgmts';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('user.email', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });
            $table->editColumn('cardholder_name', function ($row) {
                return $row->cardholder_name ? $row->cardholder_name : '';
            });
            $table->editColumn('card_no', function ($row) {
                return $row->card_no ? $row->card_no : '';
            });
            $table->editColumn('card_issuer', function ($row) {
                return $row->card_issuer ? UserCardMgmt::CARD_ISSUER_SELECT[$row->card_issuer] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        $users = User::get();

        return view('core.userCardMgmts.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_card_mgmt_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('core.userCardMgmts.create', compact('users'));
    }

    public function store(StoreUserCardMgmtRequest $request)
    {
        $userCardMgmt = UserCardMgmt::create($request->all());

        return redirect()->route('core.user-card-mgmts.index');
    }

    public function edit(UserCardMgmt $userCardMgmt)
    {
        abort_if(Gate::denies('user_card_mgmt_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userCardMgmt->load('user', 'created_by');

        return view('core.userCardMgmts.edit', compact('userCardMgmt', 'users'));
    }

    public function update(UpdateUserCardMgmtRequest $request, UserCardMgmt $userCardMgmt)
    {
        $userCardMgmt->update($request->all());

        return redirect()->route('core.user-card-mgmts.index');
    }

    public function show(UserCardMgmt $userCardMgmt)
    {
        abort_if(Gate::denies('user_card_mgmt_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userCardMgmt->load('user', 'created_by');

        return view('core.userCardMgmts.show', compact('userCardMgmt'));
    }

    public function destroy(UserCardMgmt $userCardMgmt)
    {
        abort_if(Gate::denies('user_card_mgmt_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userCardMgmt->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserCardMgmtRequest $request)
    {
        UserCardMgmt::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
