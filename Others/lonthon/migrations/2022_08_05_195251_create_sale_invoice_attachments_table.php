<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleInvoiceAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_invoice_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_invoice_id')->constrained();
            $table->string('title', 120);
            $table->string('path', 120);
            $table->string('extension', 10);
            $table->foreignId('uploaded_by')->constrained('users');
            $table->timestamp('uploaded_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_invoice_attachments');
    }
}
