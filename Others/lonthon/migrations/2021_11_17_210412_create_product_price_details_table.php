<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPriceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_price_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_id')->constrained('product_prices');
            $table->unsignedInteger('quantity')->nullable();
            $table->double('sale_price_non_gst', 15, 4);
            $table->double('sale_price_gst', 15, 4);
            $table->double('unit_price', 15, 4);
            $table->text("note")->nullable();
            $table->unsignedTinyInteger("status")->default(1)->comment("0 = Inactive, 1 = Active");
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
        Schema::dropIfExists('product_price_details');
    }
}
