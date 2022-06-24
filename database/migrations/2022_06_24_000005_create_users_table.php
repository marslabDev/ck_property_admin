<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('email')->nullable()->unique();
            $table->boolean('two_factor')->default(0)->nullable();
            $table->boolean('approved')->default(0)->nullable();
            $table->boolean('verified')->default(0)->nullable();
            $table->datetime('verified_at')->nullable();
            $table->string('verification_token')->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->string('two_factor_code')->nullable();
            $table->string('card_no')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('join_date')->nullable();
            $table->longText('address')->nullable();
            $table->longText('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->string('manage_area')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->datetime('two_factor_expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
