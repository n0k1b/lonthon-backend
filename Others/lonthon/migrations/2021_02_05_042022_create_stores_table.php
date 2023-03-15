<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string("name", 155);
            $table->string("tax_id", 155)->nullable();
            $table->string("email", 120);
            $table->string("country_code", 4)->nullable();
            $table->string("calling_code", 4)->nullable();
            $table->string("phone", 25)->nullable();
            $table->string("fax", 25)->nullable();
            $table->string("website", 155)->nullable();
            $table->tinyInteger("stock_alerts")->default(0);
            $table->string("stock_alerts_email", 155)->nullable();
            $table->unsignedTinyInteger("status")->default(1)->comment("0 = Inactive, 1 = Active");
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('stores');
    }
}
