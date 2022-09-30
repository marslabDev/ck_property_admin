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
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_7059806')->references('id')->on('case_statuses');
            $table->unsignedBigInteger('handle_by_id')->nullable();
            $table->foreign('handle_by_id', 'handle_by_fk_7043458')->references('id')->on('users');
            $table->unsignedBigInteger('report_to_id')->nullable();
            $table->foreign('report_to_id', 'report_to_fk_7043459')->references('id')->on('users');
            $table->unsignedBigInteger('from_area_id')->nullable();
            $table->foreign('from_area_id', 'from_area_fk_7088974')->references('id')->on('areas');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6872523')->references('id')->on('users');
        });
    }
}
