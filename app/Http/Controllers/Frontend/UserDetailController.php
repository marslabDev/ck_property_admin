<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUserDetailRequest;
use App\Http\Requests\StoreUserDetailRequest;
use App\Http\Requests\UpdateUserDetailRequest;
use App\Models\User;
use App\Models\UserDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserDetailController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('user_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDetails = UserDetail::with(['user', 'created_by'])->get();

        $users = User::get();

        return view('frontend.userDetails.index', compact('userDetails', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.userDetails.create', compact('users'));
    }

    public function store(StoreUserDetailRequest $request)
    {
        $userDetail = UserDetail::create($request->all());

        return redirect()->route('frontend.user-details.index');
    }

    public function edit(UserDetail $userDetail)
    {
        abort_if(Gate::denies('user_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userDetail->load('user', 'created_by');

        return view('frontend.userDetails.edit', compact('userDetail', 'users'));
    }

    public function update(UpdateUserDetailRequest $request, UserDetail $userDetail)
    {
        $userDetail->update($request->all());

        return redirect()->route('frontend.user-details.index');
    }

    public function show(UserDetail $userDetail)
    {
        abort_if(Gate::denies('user_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDetail->load('user', 'created_by');

        return view('frontend.userDetails.show', compact('userDetail'));
    }

    public function destroy(UserDetail $userDetail)
    {
        abort_if(Gate::denies('user_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserDetailRequest $request)
    {
        UserDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
