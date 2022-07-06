<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPaymentHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('payment_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('paid_by_id')->nullable();
            $table->foreign('paid_by_id', 'paid_by_fk_6831863')->references('id')->on('users');
            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->foreign('payment_type_id', 'payment_type_fk_6835893')->references('id')->on('payment_types');
        });
    }
}
