<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBillChargesTable extends Migration
{
    public function up()
    {
        Schema::table('bill_charges', function (Blueprint $table) {
            $table->unsignedBigInteger('from_area_id')->nullable();
            $table->foreign('from_area_id', 'from_area_fk_7278677')->references('id')->on('areas');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7278681')->references('id')->on('users');
        });
    }
}
