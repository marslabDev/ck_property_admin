<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBillItemsTable extends Migration
{
    public function up()
    {
        Schema::table('bill_items', function (Blueprint $table) {
            $table->unsignedBigInteger('bill_particular_id')->nullable();
            $table->foreign('bill_particular_id', 'bill_particular_fk_7278641')->references('id')->on('bill_particulars');
            $table->unsignedBigInteger('from_area_id')->nullable();
            $table->foreign('from_area_id', 'from_area_fk_7278683')->references('id')->on('areas');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7278647')->references('id')->on('users');
        });
    }
}
