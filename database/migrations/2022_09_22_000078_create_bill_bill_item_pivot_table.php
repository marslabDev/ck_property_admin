<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillBillItemPivotTable extends Migration
{
    public function up()
    {
        Schema::create('bill_bill_item', function (Blueprint $table) {
            $table->unsignedBigInteger('bill_id');
            $table->foreign('bill_id', 'bill_id_fk_7278657')->references('id')->on('bills')->onDelete('cascade');
            $table->unsignedBigInteger('bill_item_id');
            $table->foreign('bill_item_id', 'bill_item_id_fk_7278657')->references('id')->on('bill_items')->onDelete('cascade');
        });
    }
}
