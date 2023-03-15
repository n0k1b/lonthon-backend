<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->foreignId('sale_quotation_id')->nullable()->constrained();
            $table->string('invoice_no', 16);
            $table->date('invoice_date');
            $table->foreignId('rep_user_id')->constrained('users');
            $table->foreignId('cus_company_info_id')->constrained('cus_company_info');
            $table->foreignId('cus_trading_detail_id')->constrained('cus_trading_details');
            $table->unsignedTinyInteger('is_override')->default(0)->comment("0 = No, 1 = Yes");
            $table->unsignedTinyInteger('status')->default(1)->comment("1 = Approved, 2 = On Hold, 3 = Authorized");
            $table->enum('receive_type', ['pickup', 'delivery']);
            $table->date('receive_date');
            $table->date('invoice_due_date');
            $table->double('subtotal', 15, 4);
            $table->double('gst_total', 15, 4);
            $table->double('shipping_cost', 15, 4);
            $table->double('grand_total', 15, 4);
            $table->double('due_amount', 15, 4)->nullable();
            $table->unsignedTinyInteger('is_delivered')->default(0)->comment("1 = Delivered, 0 = Ready for Delivery");
            $table->json('comments')->nullable()->comment('[{"user_id":"","comment":"","status":1,"created_at":""}]');
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
        Schema::dropIfExists('sale_invoices');
    }
}
