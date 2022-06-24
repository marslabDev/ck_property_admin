<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintanancesTable extends Migration
{
    public function up()
    {
        Schema::create('maintanances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_maintanance')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
