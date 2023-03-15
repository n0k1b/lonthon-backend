<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_order_no', 16);
            $table->foreignId('store_id')->constrained('stores');
            $table->foreignId('supplier_id')->constrained('sup_company_info');
            $table->date('purchase_date');
            $table->date('receive_date')->nullable();
            $table->string('supplier_invoice_no', 20)->nullable();
            $table->date('expected_delivery_date')->nullable();
            $table->decimal('sub_total', 15, 4);
            $table->decimal('total_gst', 15, 4);
            $table->decimal('total_amount', 15, 4);
            $table->text('note')->nullable();
            $table->unsignedTinyInteger("status")->default(0)->comment("0 = Pending, 1 = Received");
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('receive_by')->nullable()->constrained('users');
            $table->timestamp('receive_at')->nullable();
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
        Schema::dropIfExists('purchase_order');
    }
}
