<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_return_id', 16);
            $table->foreignId('purchase_order_id')->constrained('purchase_order');
            $table->foreignId('supplier_id')->constrained('sup_company_info');
            $table->date('return_date');
            $table->decimal('sub_total', 15, 4);
            $table->decimal('total_gst', 15, 4);
            $table->decimal('total_amount', 15, 4);
            $table->json('product_snapshot')->comment('[{"id":" ","unit":" ","unit_sold":"","unit_price":"","return_quantity":" ","total":" "}]');
            $table->integer('return_reason');
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('purchase_returns');
    }
}
