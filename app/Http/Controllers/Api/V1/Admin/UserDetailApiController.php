<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserDetailRequest;
use App\Http\Requests\UpdateUserDetailRequest;
use App\Http\Resources\Admin\UserDetailResource;
use App\Models\UserDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserDetailApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserDetailResource(UserDetail::with(['user', 'created_by'])->get());
    }

    public function store(StoreUserDetailRequest $request)
    {
        $userDetail = UserDetail::create($request->all());

        return (new UserDetailResource($userDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UserDetail $userDetail)
    {
        abort_if(Gate::denies('user_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserDetailResource($userDetail->load(['user', 'created_by']));
    }

    public function update(UpdateUserDetailRequest $request, UserDetail $userDetail)
    {
        $userDetail->update($request->all());

        return (new UserDetailResource($userDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UserDetail $userDetail)
    {
        abort_if(Gate::denies('user_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
