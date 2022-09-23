<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBillsTable extends Migration
{
    public function up()
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->unsignedBigInteger('house_id')->nullable();
            $table->foreign('house_id', 'house_fk_7278653')->references('id')->on('manage_houses');
            $table->unsignedBigInteger('homeowner_id')->nullable();
            $table->foreign('homeowner_id', 'homeowner_fk_7278654')->references('id')->on('users');
            $table->unsignedBigInteger('bill_status_id')->nullable();
            $table->foreign('bill_status_id', 'bill_status_fk_7285069')->references('id')->on('bill_statuses');
            $table->unsignedBigInteger('from_area_id')->nullable();
            $table->foreign('from_area_id', 'from_area_fk_7278682')->references('id')->on('areas');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7278662')->references('id')->on('users');
        });
    }
}
