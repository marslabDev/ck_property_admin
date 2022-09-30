<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('billplz')->unique();
            $table->string('billplz_url');
            $table->date('billing_date');
            $table->date('due_date');
            $table->decimal('amount', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
