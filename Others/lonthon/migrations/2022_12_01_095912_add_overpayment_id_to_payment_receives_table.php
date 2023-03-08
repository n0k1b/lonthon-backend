<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOverpaymentIdToPaymentReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_receives', function (Blueprint $table) {
            //
            $table->json('overpayment_payment_receive_id')->nullable()->after('overpayment');
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
            //
            $table->dropColumn(['overpayment_payment_receive_id']);
        });
    }
}
