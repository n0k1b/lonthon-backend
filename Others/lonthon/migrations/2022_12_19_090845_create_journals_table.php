<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->string('reference_id', 120)->nullable();
            $table->foreignId('sale_invoice_id')->nullable()->constrained('sale_invoices');
            $table->unsignedTinyInteger('voucher_type')->nullable()->comment('1=journal, 2=debit, 3=credit, 4=invoice, 5=expense');
            $table->string('voucher_no', 20)->nullable();
            $table->string('transaction_no', 20)->nullable();
            $table->tinyText('note')->nullable();
            $table->unsignedTinyInteger('process_status')->default(0)->comment('0 = pending, 1 = Processed');
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
        Schema::dropIfExists('journals');
    }
}
