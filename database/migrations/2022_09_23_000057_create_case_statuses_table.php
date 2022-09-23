<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('case_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->boolean('status_linking')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
