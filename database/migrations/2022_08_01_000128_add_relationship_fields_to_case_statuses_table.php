<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCaseStatusesTable extends Migration
{
    public function up()
    {
        Schema::table('case_statuses', function (Blueprint $table) {
            $table->unsignedBigInteger('complaint_status_id')->nullable();
            $table->foreign('complaint_status_id', 'complaint_status_fk_7074764')->references('id')->on('complaint_statuses');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7059386')->references('id')->on('users');
        });
    }
}
