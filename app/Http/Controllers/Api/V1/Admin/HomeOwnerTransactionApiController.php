<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\HomeOwnerTransactionResource;
use App\Models\HomeOwnerTransaction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeOwnerTransactionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('home_owner_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HomeOwnerTransactionResource(HomeOwnerTransaction::with(['user', 'house', 'payment_plan', 'payment_type', 'created_by'])->get());
    }
}
