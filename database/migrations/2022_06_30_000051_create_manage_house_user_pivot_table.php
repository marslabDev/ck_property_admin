<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageHouseUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('manage_house_user', function (Blueprint $table) {
            $table->unsignedBigInteger('manage_house_id');
            $table->foreign('manage_house_id', 'manage_house_id_fk_6895274')->references('id')->on('manage_houses')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_6895274')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
