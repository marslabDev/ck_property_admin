<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToManagePricesTable extends Migration
{
    public function up()
    {
        Schema::table('manage_prices', function (Blueprint $table) {
            $table->unsignedBigInteger('house_type_id')->nullable();
            $table->foreign('house_type_id', 'house_type_fk_6902972')->references('id')->on('house_types');
            $table->unsignedBigInteger('from_area_id')->nullable();
            $table->foreign('from_area_id', 'from_area_fk_7089352')->references('id')->on('areas');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6902977')->references('id')->on('users');
        });
    }
}
