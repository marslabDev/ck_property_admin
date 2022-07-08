<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentItemPaymentPlanPivotTable extends Migration
{
    public function up()
    {
        Schema::create('payment_item_payment_plan', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_plan_id');
            $table->foreign('payment_plan_id', 'payment_plan_id_fk_6943212')->references('id')->on('payment_plans')->onDelete('cascade');
            $table->unsignedBigInteger('payment_item_id');
            $table->foreign('payment_item_id', 'payment_item_id_fk_6943212')->references('id')->on('payment_items')->onDelete('cascade');
        });
    }
}
