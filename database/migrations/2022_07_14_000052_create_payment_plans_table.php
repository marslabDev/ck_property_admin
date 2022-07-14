<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentPlansTable extends Migration
{
    public function up()
    {
        Schema::create('payment_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('due_date');
            $table->string('due_day');
            $table->boolean('recusive_payment')->default(0)->nullable();
            $table->integer('cycle_every')->nullable();
            $table->string('cycle_by')->nullable();
            $table->integer('no_of_cycle')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
