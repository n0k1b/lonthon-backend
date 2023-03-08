<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained('purchase_order');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('tax_id')->constrained('taxes');
            $table->unsignedInteger('stock_on_hand');
            $table->unsignedSmallInteger('quantity');
            $table->decimal('last_po_cost_per_unit', 15, 4);
            $table->decimal('exclude_gst_rate', 15, 4);
            $table->decimal('total_gst', 15, 4);
            $table->decimal('include_gst_gross_price', 15, 4);
            $table->decimal('include_gst_total', 15, 4);
            $table->date('manufacture_date')->nullable();
            $table->date('expire_date')->nullable();
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
        Schema::dropIfExists('purchase_order_details');
    }
}
