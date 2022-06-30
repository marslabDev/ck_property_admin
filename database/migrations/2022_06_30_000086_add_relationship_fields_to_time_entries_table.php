<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTimeEntriesTable extends Migration
{
    public function up()
    {
        Schema::table('time_entries', function (Blueprint $table) {
            $table->unsignedBigInteger('work_type_id')->nullable();
            $table->foreign('work_type_id', 'work_type_fk_6856072')->references('id')->on('time_work_types');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id', 'project_fk_6856073')->references('id')->on('time_projects');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6872533')->references('id')->on('users');
        });
    }
}
