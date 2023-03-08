<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPaymentReceivesTable extends Migration
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
            $table->decimal('overpayment', 15, 4)->nullable()->after('is_deposited');
            $table->date('overpayment_use_date')->nullable()->after('overpayment');
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
        });
    }
}
