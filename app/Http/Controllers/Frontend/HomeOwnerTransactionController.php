<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Models\Area;
use App\Models\HomeOwnerTransaction;
use App\Models\ManageHouse;
use App\Models\PaymentPlan;
use App\Models\PaymentType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeOwnerTransactionController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('home_owner_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homeOwnerTransactions = HomeOwnerTransaction::with(['user', 'house', 'payment_plan', 'payment_type', 'created_by', 'from_area'])->get();

        $users = User::get();

        $manage_houses = ManageHouse::get();

        $payment_plans = PaymentPlan::get();

        $payment_types = PaymentType::get();

        $areas = Area::get();

        return view('frontend.homeOwnerTransactions.index', compact('areas', 'homeOwnerTransactions', 'manage_houses', 'payment_plans', 'payment_types', 'users'));
    }
}
