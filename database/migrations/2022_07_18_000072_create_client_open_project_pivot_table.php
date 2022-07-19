<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientOpenProjectPivotTable extends Migration
{
    public function up()
    {
        Schema::create('client_open_project', function (Blueprint $table) {
            $table->unsignedBigInteger('open_project_id');
            $table->foreign('open_project_id', 'open_project_id_fk_7004631')->references('id')->on('open_projects')->onDelete('cascade');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id', 'client_id_fk_7004631')->references('id')->on('clients')->onDelete('cascade');
        });
    }
}
