<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageHousesTable extends Migration
{
    public function up()
    {
        Schema::create('manage_houses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unit_no');
            $table->string('floor')->nullable();
            $table->string('block')->nullable();
            $table->string('street');
            $table->float('square_feet', 15, 2);
            $table->string('house_status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
