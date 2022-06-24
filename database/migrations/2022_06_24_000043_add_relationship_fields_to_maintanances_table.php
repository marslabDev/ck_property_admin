<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMaintanancesTable extends Migration
{
    public function up()
    {
        Schema::table('maintanances', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id', 'type_fk_6836009')->references('id')->on('maintanance_types');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id', 'area_fk_6836010')->references('id')->on('areas');
            $table->unsignedBigInteger('handle_by_id')->nullable();
            $table->foreign('handle_by_id', 'handle_by_fk_6836011')->references('id')->on('users');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id', 'supplier_fk_6836012')->references('id')->on('users');
        });
    }
}
