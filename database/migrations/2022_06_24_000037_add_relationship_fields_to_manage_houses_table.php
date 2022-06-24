<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToManageHousesTable extends Migration
{
    public function up()
    {
        Schema::table('manage_houses', function (Blueprint $table) {
            $table->unsignedBigInteger('parking_lot_id')->nullable();
            $table->foreign('parking_lot_id', 'parking_lot_fk_6835901')->references('id')->on('parking_lots');
        });
    }
}
