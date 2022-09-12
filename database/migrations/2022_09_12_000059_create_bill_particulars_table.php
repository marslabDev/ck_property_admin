<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillParticularsTable extends Migration
{
    public function up()
    {
        Schema::create('bill_particulars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->float('unit_price', 15, 2);
            $table->string('uom');
            $table->longText('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
