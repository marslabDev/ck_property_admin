<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkingLotsTable extends Migration
{
    public function up()
    {
        Schema::create('parking_lots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lot_no');
            $table->integer('floor')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
