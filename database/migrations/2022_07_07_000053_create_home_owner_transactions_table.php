<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeOwnerTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('home_owner_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount_paid', 15, 2);
            $table->decimal('changes', 15, 2);
            $table->longText('details')->nullable();
            $table->timestamps();
        });
    }
}
