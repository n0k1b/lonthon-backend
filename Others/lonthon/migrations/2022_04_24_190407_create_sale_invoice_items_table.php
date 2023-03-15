<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_invoice_id')->constrained('sale_invoices');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('price_details_id')->constrained('product_price_details');
            $table->unsignedSmallInteger('quantity')->default(0);
            $table->double('rate', 15, 4);
            $table->double('gst', 15, 4)->comment('TAX Amount');
            $table->double('total', 15, 4);
            $table->foreignId('created_by')->constrained('users');
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
        Schema::dropIfExists('sale_invoice_items');
    }
}
