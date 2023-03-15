<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGetDiscountProductToSaleInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_invoice_items', function (Blueprint $table) {
            //
            $table->boolean('get_discount_product')->default(false)->after('discount_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale_invoice_items', function (Blueprint $table) {
            //
            $table->dropColumn(['get_discount_product']);

        });
    }
}
