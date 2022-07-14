<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaProjectPivotTable extends Migration
{
    public function up()
    {
        Schema::create('area_project', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id', 'project_id_fk_6977018')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id', 'area_id_fk_6977018')->references('id')->on('areas')->onDelete('cascade');
        });
    }
}
