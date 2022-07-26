<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentChargePaymentPlanPivotTable extends Migration
{
    public function up()
    {
        Schema::create('payment_charge_payment_plan', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_plan_id');
            $table->foreign('payment_plan_id', 'payment_plan_id_fk_6943975')->references('id')->on('payment_plans')->onDelete('cascade');
            $table->unsignedBigInteger('payment_charge_id');
            $table->foreign('payment_charge_id', 'payment_charge_id_fk_6943975')->references('id')->on('payment_charges')->onDelete('cascade');
        });
    }
}
