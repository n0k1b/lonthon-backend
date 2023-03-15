<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOverpaymentInvoiceIdToPaymentReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_receives', function (Blueprint $table) {
            $table->foreignId('overpayment_invoice_id')->after('overpayment')->nullable()->constrained('sale_invoices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_receives', function (Blueprint $table) {
            $table->dropColumn(['overpayment_invoice_id']);
        });
    }
}
