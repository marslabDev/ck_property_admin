<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintMyCasePivotTable extends Migration
{
    public function up()
    {
        Schema::create('complaint_my_case', function (Blueprint $table) {
            $table->unsignedBigInteger('my_case_id');
            $table->foreign('my_case_id', 'my_case_id_fk_7043461')->references('id')->on('my_cases')->onDelete('cascade');
            $table->unsignedBigInteger('complaint_id');
            $table->foreign('complaint_id', 'complaint_id_fk_7043461')->references('id')->on('complaints')->onDelete('cascade');
        });
    }
}
