<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('store_id')->constrained();
            $table->dateTime('date_tracking');
            $table->unsignedTinyInteger("invoice_type")->comment('1 = Purchase, 2 = Purchase Return, 3 = Sales, 4 = Sales Return, 5 = Wastage');
            $table->unsignedBigInteger('reference');
            $table->enum('operation_type', ['In', 'Out']);
            $table->unsignedInteger('quantity')->default(0);
            $table->double('unit_price', 15, 4)->default(0);
            $table->double('quantity_in_stock', 15, 4)->default(0);
            $table->unsignedTinyInteger("is_active")->default(1);
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->string("created_by_ip", 16)->nullable();
            $table->string("updated_by_ip", 16)->nullable();
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
        Schema::dropIfExists('inventory_logs');
    }
}
