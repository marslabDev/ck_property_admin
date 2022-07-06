<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUserCardMgmtRequest;
use App\Http\Requests\StoreUserCardMgmtRequest;
use App\Http\Requests\UpdateUserCardMgmtRequest;
use App\Models\User;
use App\Models\UserCardMgmt;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserCardMgmtController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('user_card_mgmt_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userCardMgmts = UserCardMgmt::with(['user', 'created_by'])->get();

        $users = User::get();

        return view('frontend.userCardMgmts.index', compact('userCardMgmts', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_card_mgmt_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.userCardMgmts.create', compact('users'));
    }

    public function store(StoreUserCardMgmtRequest $request)
    {
        $userCardMgmt = UserCardMgmt::create($request->all());

        return redirect()->route('frontend.user-card-mgmts.index');
    }

    public function edit(UserCardMgmt $userCardMgmt)
    {
        abort_if(Gate::denies('user_card_mgmt_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userCardMgmt->load('user', 'created_by');

        return view('frontend.userCardMgmts.edit', compact('userCardMgmt', 'users'));
    }

    public function update(UpdateUserCardMgmtRequest $request, UserCardMgmt $userCardMgmt)
    {
        $userCardMgmt->update($request->all());

        return redirect()->route('frontend.user-card-mgmts.index');
    }

    public function show(UserCardMgmt $userCardMgmt)
    {
        abort_if(Gate::denies('user_card_mgmt_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userCardMgmt->load('user', 'created_by');

        return view('frontend.userCardMgmts.show', compact('userCardMgmt'));
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
