<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierProposalsTable extends Migration
{
    public function up()
    {
        Schema::create('supplier_proposals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('representative_name');
            $table->string('contact_no');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
