<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_receives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->foreignId('customer_company_info_id')->constrained('cus_company_info');
            $table->string('payment_receive_id', 16);
            $table->decimal('amount', 15, 4);
            $table->date('payment_record_date');
            $table->enum("payment_method", ['EFT', 'Cash', 'Cheque', 'Credit Card', 'Adjustment Note']);
            $table->string('cheque_no', 30)->nullable();
            $table->date('cheque_date')->nullable();
            $table->text('note')->nullable();
            $table->json('invoice_ids')->comment('[1,2,3]');
            $table->json('invoice_snapshot')->comment('[{"id":"","invoice_no":"","grand_total":"","due_amount":"","payment_amount":"","underpayment":"","overpayment":""}]');;
            $table->unsignedTinyInteger("is_deposited")->default(0)->comment("0 = Ready for Deposit, 1 = Deposited");
            $table->date('deposited_date')->nullable();
            $table->unsignedInteger('deposited_bank_id')->nullable();
            $table->foreignId('deposited_by')->nullable()->constrained('users');
            $table->timestamp('deposited_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('payment_receives');
    }
}
