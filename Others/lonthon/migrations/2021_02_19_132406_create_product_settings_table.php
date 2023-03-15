<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('store_id')->constrained();
            $table->unsignedInteger('replenish_level')->nullable()->comment("In Units");
            $table->unsignedInteger('total_purchases')->default(0)->comment("In Units");
            $table->unsignedInteger('total_sales')->default(0)->comment("In Units");
            $table->unsignedInteger('quantity')->default(0)->comment("On Hand");
            $table->unsignedInteger('damaged_quantity')->default(0);
            $table->unsignedBigInteger('po_ref')->nullable()->comment("Purchase order reference for the expiry date");
            $table->date('modified_expiry_date')->nullable();
            $table->unsignedTinyInteger("is_active")->default(1);
            $table->foreignId('created_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('product_settings');
    }
}
