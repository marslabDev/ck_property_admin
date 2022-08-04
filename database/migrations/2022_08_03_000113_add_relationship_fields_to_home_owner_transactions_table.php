<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHomeOwnerTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('home_owner_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_6943054')->references('id')->on('users');
            $table->unsignedBigInteger('house_id')->nullable();
            $table->foreign('house_id', 'house_fk_6943055')->references('id')->on('manage_houses');
            $table->unsignedBigInteger('payment_plan_id')->nullable();
            $table->foreign('payment_plan_id', 'payment_plan_fk_6943056')->references('id')->on('payment_plans');
            $table->unsignedBigInteger('payment_type_id')->nullable();
            $table->foreign('payment_type_id', 'payment_type_fk_6943057')->references('id')->on('payment_types');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6943063')->references('id')->on('users');
            $table->unsignedBigInteger('from_area_id')->nullable();
            $table->foreign('from_area_id', 'from_area_fk_7090308')->references('id')->on('areas');
        });
    }
}
