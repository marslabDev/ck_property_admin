<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToNoticesTable extends Migration
{
    public function up()
    {
        Schema::table('notices', function (Blueprint $table) {
            $table->unsignedBigInteger('people_in_role_id')->nullable();
            $table->foreign('people_in_role_id', 'people_in_role_fk_6835986')->references('id')->on('roles');
            $table->unsignedBigInteger('people_in_area_id')->nullable();
            $table->foreign('people_in_area_id', 'people_in_area_fk_6902940')->references('id')->on('areas');
            $table->unsignedBigInteger('create_by_id')->nullable();
            $table->foreign('create_by_id', 'create_by_fk_6835985')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6872521')->references('id')->on('users');
        });
    }
}
