<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('journal_id')->constrained('journals');
            $table->foreignId('chart_of_account_id')->constrained('chart_of_accounts');
            $table->double('debit_amount', 15, 4)->nullable();
            $table->double('credit_amount', 15, 4)->nullable();
            $table->double('net_amount', 15, 4)->nullable();
            $table->double('gst', 15, 4)->nullable();
            $table->double('balance', 15, 4)->nullable();
            $table->enum('operation_type', ['+', '-'])->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ledgers');
    }
}
