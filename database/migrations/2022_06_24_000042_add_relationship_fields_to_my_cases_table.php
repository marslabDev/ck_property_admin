<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMyCasesTable extends Migration
{
    public function up()
    {
        Schema::table('my_cases', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id', 'category_fk_6836000')->references('id')->on('cases_categories');
            $table->unsignedBigInteger('report_by_id')->nullable();
            $table->foreign('report_by_id', 'report_by_fk_6836001')->references('id')->on('users');
            $table->unsignedBigInteger('handle_by_id')->nullable();
            $table->foreign('handle_by_id', 'handle_by_fk_6836002')->references('id')->on('users');
        });
    }
}
