<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentPaymentPlanPivotTable extends Migration
{
    public function up()
    {
        Schema::create('payment_payment_plan', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_plan_id');
            $table->foreign('payment_plan_id', 'payment_plan_id_fk_6938565')->references('id')->on('payment_plans')->onDelete('cascade');
            $table->unsignedBigInteger('payment_id');
            $table->foreign('payment_id', 'payment_id_fk_6938565')->references('id')->on('payments')->onDelete('cascade');
        });
    }
}
