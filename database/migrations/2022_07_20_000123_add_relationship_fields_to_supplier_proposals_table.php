<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSupplierProposalsTable extends Migration
{
    public function up()
    {
        Schema::table('supplier_proposals', function (Blueprint $table) {
            $table->unsignedBigInteger('open_project_id')->nullable();
            $table->foreign('open_project_id', 'open_project_fk_7015430')->references('id')->on('open_projects');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_7009194')->references('id')->on('users');
        });
    }
}
