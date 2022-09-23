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
            $table->unsignedBigInteger('street_id')->nullable();
            $table->foreign('street_id', 'street_fk_6937200')->references('id')->on('streets');
            $table->unsignedBigInteger('house_status_id')->nullable();
            $table->foreign('house_status_id', 'house_status_fk_6947744')->references('id')->on('house_statuses');
            $table->unsignedBigInteger('contact_person_id')->nullable();
            $table->foreign('contact_person_id', 'contact_person_fk_6947745')->references('id')->on('users');
            $table->unsignedBigInteger('contact_person_2_id')->nullable();
            $table->foreign('contact_person_2_id', 'contact_person_2_fk_6947746')->references('id')->on('users');
            $table->unsignedBigInteger('from_area_id')->nullable();
            $table->foreign('from_area_id', 'from_area_fk_7089324')->references('id')->on('areas');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6872519')->references('id')->on('users');
        });
    }
}
