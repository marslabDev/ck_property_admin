<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBillHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('bill_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('paid_by_id')->nullable();
            $table->foreign('paid_by_id', 'paid_by_fk_7285692')->references('id')->on('users');
            $table->unsignedBigInteger('bill_id')->nullable();
            $table->foreign('bill_id', 'bill_fk_7285693')->references('id')->on('bills');
            $table->unsignedBigInteger('from_area_id')->nullable();
            $table->foreign('from_area_id', 'from_area_fk_7285704')->references('id')->on('areas');
        });
    }
}
