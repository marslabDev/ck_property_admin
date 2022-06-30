<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageHouseParkingLotPivotTable extends Migration
{
    public function up()
    {
        Schema::create('manage_house_parking_lot', function (Blueprint $table) {
            $table->unsignedBigInteger('manage_house_id');
            $table->foreign('manage_house_id', 'manage_house_id_fk_6898582')->references('id')->on('manage_houses')->onDelete('cascade');
            $table->unsignedBigInteger('parking_lot_id');
            $table->foreign('parking_lot_id', 'parking_lot_id_fk_6898582')->references('id')->on('parking_lots')->onDelete('cascade');
        });
    }
}
