<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('area_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_7088331')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id', 'area_id_fk_7088331')->references('id')->on('areas')->onDelete('cascade');
        });
    }
}
