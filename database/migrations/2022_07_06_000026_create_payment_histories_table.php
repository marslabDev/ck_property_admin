<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_received')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->timestamps();
        });
    }
}
