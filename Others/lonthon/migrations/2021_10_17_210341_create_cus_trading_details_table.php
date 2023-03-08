<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCusTradingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        Schema::create('cus_trading_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cus_company_info_id')->constrained('cus_company_info');
            $table->string('name', 160);
            $table->string('email', 120)->nullable();
            $table->json('contact_ids')->nullable();
            $table->foreignId('primary_contact_id')->nullable()->constrained('cus_contact_details');
            $table->json('delivery_day')->comment("[1=Mon, 2=Tue]");
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
        Schema::dropIfExists('cus_trading_details');
    }
}
