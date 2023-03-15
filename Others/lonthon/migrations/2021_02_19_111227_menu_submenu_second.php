<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MenuSubmenuSecond extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('sub_menu_second', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('submenu_id')->unsigned();
            $table->foreign('submenu_id')->references('id')->on('sub_menu_first');
            $table->string('name');
            $table->string('route');
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
