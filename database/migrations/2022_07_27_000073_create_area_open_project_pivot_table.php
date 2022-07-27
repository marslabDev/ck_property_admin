<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaOpenProjectPivotTable extends Migration
{
    public function up()
    {
        Schema::create('area_open_project', function (Blueprint $table) {
            $table->unsignedBigInteger('open_project_id');
            $table->foreign('open_project_id', 'open_project_id_fk_7004628')->references('id')->on('open_projects')->onDelete('cascade');
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id', 'area_id_fk_7004628')->references('id')->on('areas')->onDelete('cascade');
        });
    }
}
