<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToManageHousesTable extends Migration
{
    public function up()
    {
        Schema::table('manage_houses', function (Blueprint $table) {
            $table->unsignedBigInteger('house_type_id')->nullable();
            $table->foreign('house_type_id', 'house_type_fk_6898277')->references('id')->on('house_types');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6872519')->references('id')->on('users');
        });
    }
}
