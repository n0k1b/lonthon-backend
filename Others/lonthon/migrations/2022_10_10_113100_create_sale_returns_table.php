<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->foreignId('invoice_id')->constrained('sale_invoices');
            $table->foreignId('customer_company_info_id')->constrained('cus_company_info');
            $table->string('sale_return_id', 16);
            $table->date('return_date');
            $table->decimal('sub_total', 15, 4);
            $table->decimal('gst', 15, 4);
            $table->decimal('total', 15, 4);
            $table->json('product_snapshot')->comment('[{"id":" ","unit":" ","unit_sold":"","unit_price":"","return_quantity":" ","total":" "}]');
            $table->integer('return_reason');
            $table->string('notes')->nullable();
            $table->unsignedTinyInteger('invoice_adjustment');
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
        Schema::dropIfExists('sale_returns');
    }
}
