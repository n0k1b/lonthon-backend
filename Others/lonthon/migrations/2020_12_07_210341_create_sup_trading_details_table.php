<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupTradingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('sup_trading_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sup_company_info_id')->constrained('sup_company_info');
            $table->string('name', 160)->nullable();
            $table->string('email', 120)->nullable();
            $table->json('contact_ids')->nullable();
            $table->foreignId('primary_contact_id')->nullable()->constrained('sup_contact_details');
            $table->softDeletes();
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
        Schema::dropIfExists('sup_trading_details');
    }
}
