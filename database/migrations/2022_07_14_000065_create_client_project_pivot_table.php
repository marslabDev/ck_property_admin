<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientProjectPivotTable extends Migration
{
    public function up()
    {
        Schema::create('client_project', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id', 'project_id_fk_6976954')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id', 'client_id_fk_6976954')->references('id')->on('clients')->onDelete('cascade');
        });
    }
}
