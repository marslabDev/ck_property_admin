<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCardMgmtsTable extends Migration
{
    public function up()
    {
        Schema::create('user_card_mgmts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cardholder_name');
            $table->string('card_no');
            $table->string('card_issuer');
            $table->date('expiration_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
