<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserCardMgmtRequest;
use App\Http\Requests\UpdateUserCardMgmtRequest;
use App\Http\Resources\Admin\UserCardMgmtResource;
use App\Models\UserCardMgmt;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserCardMgmtApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_card_mgmt_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserCardMgmtResource(UserCardMgmt::with(['user', 'created_by'])->get());
    }

    public function store(StoreUserCardMgmtRequest $request)
    {
        $userCardMgmt = UserCardMgmt::create($request->all());

        return (new UserCardMgmtResource($userCardMgmt))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UserCardMgmt $userCardMgmt)
    {
        abort_if(Gate::denies('user_card_mgmt_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserCardMgmtResource($userCardMgmt->load(['user', 'created_by']));
    }

    public function update(UpdateUserCardMgmtRequest $request, UserCardMgmt $userCardMgmt)
    {
        $userCardMgmt->update($request->all());

        return (new UserCardMgmtResource($userCardMgmt))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UserCardMgmt $userCardMgmt)
    {
        abort_if(Gate::denies('user_card_mgmt_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userCardMgmt->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
