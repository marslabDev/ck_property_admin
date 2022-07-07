<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentChargesTable extends Migration
{
    public function up()
    {
        Schema::create('payment_charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('particular');
            $table->string('type');
            $table->decimal('amount', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
