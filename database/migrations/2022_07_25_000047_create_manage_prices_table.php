<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagePricesTable extends Migration
{
    public function up()
    {
        Schema::create('manage_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price_per_sq_ft', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
