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
            $table->string('contact_name')->nullable();
            $table->float('contact_no')->nullable();
            $table->string('house_status');
            $table->integer('spuare_feet');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
