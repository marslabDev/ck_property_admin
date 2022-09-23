<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillChargesTable extends Migration
{
    public function up()
    {
        Schema::create('bill_charges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type');
            $table->float('rate', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
