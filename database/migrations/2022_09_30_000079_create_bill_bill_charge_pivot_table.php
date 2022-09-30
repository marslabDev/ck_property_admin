<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillBillChargePivotTable extends Migration
{
    public function up()
    {
        Schema::create('bill_bill_charge', function (Blueprint $table) {
            $table->unsignedBigInteger('bill_id');
            $table->foreign('bill_id', 'bill_id_fk_7285280')->references('id')->on('bills')->onDelete('cascade');
            $table->unsignedBigInteger('bill_charge_id');
            $table->foreign('bill_charge_id', 'bill_charge_id_fk_7285280')->references('id')->on('bill_charges')->onDelete('cascade');
        });
    }
}
