<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyCasesTable extends Migration
{
    public function up()
    {
        Schema::create('my_cases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->datetime('opened_at');
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
