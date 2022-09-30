<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPaymentPlansTable extends Migration
{
    public function up()
    {
        Schema::table('payment_plans', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_6938463')->references('id')->on('users');
            $table->unsignedBigInteger('house_id')->nullable();
            $table->foreign('house_id', 'house_fk_6938825')->references('id')->on('manage_houses');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6938438')->references('id')->on('users');
        });
    }
}
