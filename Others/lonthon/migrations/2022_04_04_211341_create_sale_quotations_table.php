<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('sale_quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->unsignedTinyInteger('customer_type')->comment("1 = New Customer, 2 = Existing Customer");
            $table->string('quotation_no', 16);
            $table->date('quotation_date');
            $table->date('quotation_expiry_date');
            $table->foreignId('rep_user_id')->constrained('users');
            $table->foreignId('cus_company_info_id')->nullable()->constrained('cus_company_info');
            $table->unsignedTinyInteger('conversion_status')->default(0)->comment("0 = No, 1 = Convert to invoice");
            $table->string('customer_name', 200)->nullable();
            $table->string('calling_code', 4)->nullable();
            $table->string('country_code', 4)->nullable();
            $table->string('mobile', 15)->nullable();
            $table->string('email', 120)->nullable();
            $table->string('abn', 120)->nullable();
            $table->double('subtotal', 15, 4);
            $table->double('gst_total', 15, 4);
            $table->double('grand_total', 15, 4);
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
        Schema::dropIfExists('sale_quotations');
    }
}
