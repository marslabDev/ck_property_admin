<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToComplaintSystemsTable extends Migration
{
    public function up()
    {
        Schema::table('complaint_systems', function (Blueprint $table) {
            $table->unsignedBigInteger('create_by_id')->nullable();
            $table->foreign('create_by_id', 'create_by_fk_6831977')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6872526')->references('id')->on('users');
        });
    }
}
