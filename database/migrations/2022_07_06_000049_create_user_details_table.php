<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ic_no');
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->longText('address_line_1')->nullable();
            $table->longText('address_line_2')->nullable();
            $table->string('city');
            $table->string('postcode');
            $table->string('state');
            $table->string('country');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
