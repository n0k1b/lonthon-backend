<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('discount_type')->default(1)->comment("Amount of  products =1, Amount of Order =2, Buy X Get Y =3, Free Shipping =4");
            $table->unsignedTinyInteger('method')->default(2)->comment("Discount code= 1, Title=2");
            $table->string('method_value', 100)->comment("Title or Discount Code");
            $table->unsignedTinyInteger('value_type')->nullable()->comment("Percentage = 1, Fixed amount = 2");
            $table->double('type_value', 8, 2)->nullable()->comment("Value of Percentage Or Fixed Amount value");
            $table->unsignedTinyInteger('applies_type')->nullable()->comment("Specific Category=1, Specific Brand = 2, Specific Products=3");
            $table->json('applies_values')->nullable()->comment("category ids or brand ids, product ids");
            $table->unsignedTinyInteger('min_purchase_requirements')->nullable()->comment("No minimum requirements=0, Minimum purchase amount ($)=1, Minimum quantity of items=2");
            $table->unsignedTinyInteger('is_apply_discount_once_per_order')->default(0)->comment("true =1, false =0");
            $table->double('minimum_purchase_value', 8, 2)->nullable();
            $table->json('combinations')->nullable()->comment("Other product discounts=1, Shipping discounts=2");
            $table->unsignedTinyInteger('customer_eligibility')->nullable()->comment("All =1,  group=2 , Specific=3");
            $table->json('customer_eligibility_values')->nullable()->comment("customer ids, group ids");
            $table->unsignedTinyInteger('customer_spends_type')->nullable()->comment("Minimum quantity of items =1 , Minimum purchase amount = 2");
            $table->double('spends_value', 8, 2)->nullable();
            $table->unsignedTinyInteger('buy_item_value_type')->nullable()->comment("specific product =1, specific category=2");
            $table->json('buy_item_type_values')->nullable()->comment("product ids or category ids");
            $table->unsignedSmallInteger('get_quantity')->nullable();
            $table->unsignedSmallInteger('get_item_value_type')->nullable()->comment("specific product =1, specific category=2");
            $table->json('get_item_type_values')->nullable()->comment("product ids or category ids");
            $table->unsignedTinyInteger('region_type')->nullable()->comment("all=1, selected =2");
            $table->json('selected_country_ids')->nullable()->comment("[1,2,..]");
            $table->double('shipping_rate', 8, 2)->nullable();
            $table->unsignedSmallInteger('max_limit_discount_used_total')->nullable();
            $table->unsignedTinyInteger('max_uses_one_per_customer')->nullable();
            $table->unsignedTinyInteger('set_max_uses_per_order')->nullable();
            $table->timestamp('start_date_time')->nullable();
            $table->unsignedTinyInteger('is_continue')->default(1)->comment("true =1, false =0");
            $table->timestamp('end_date_time')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment("active=1, inactive =2");
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
