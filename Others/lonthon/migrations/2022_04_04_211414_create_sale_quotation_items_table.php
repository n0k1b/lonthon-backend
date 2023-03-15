<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleQuotationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_quotation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_quotation_id')->constrained('sale_quotations');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('price_details_id')->constrained('product_price_details');
            $table->unsignedSmallInteger('quantity')->default(0);
            $table->double('rate', 15, 4);
            $table->double('gst', 15, 4);
            $table->double('total', 15, 4);
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('sale_quotation_items');
    }
}
