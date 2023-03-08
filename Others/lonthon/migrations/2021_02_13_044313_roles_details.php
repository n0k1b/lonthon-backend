<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RolesDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->biginteger('module_id')->unsigned();
            $table->foreign('module_id')->references('id')->on('modules');
            $table->biginteger('access_level_id')->unsigned();
            $table->foreign('access_level_id')->references('id')->on('access_levels');
            $table->string('created_by');
            $table->boolean('soft_delete');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
