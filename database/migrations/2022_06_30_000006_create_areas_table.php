<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->float('office_no');
            $table->longText('address_line');
            $table->longText('address_line_2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->integer('postcode');
            $table->string('country');
            $table->decimal('price_per_ft', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
