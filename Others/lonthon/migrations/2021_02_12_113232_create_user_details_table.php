<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->unsignedTinyInteger('type')->comment("0 = Admin, 1 = Customer, 2 = Supplier, 3 = AyersRock Employee");
            $table->unsignedMediumInteger('employee_no')->nullable();
            $table->string('name', 120)->nullable();
            $table->string('sur_name', 60)->nullable();
            $table->date('dob')->nullable();
            $table->string('mobile_country_code', 4)->nullable();
            $table->string('mobile_calling_code', 4)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('phone_country_code', 4)->nullable();
            $table->string('phone_calling_code', 4)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('picture', 155)->nullable();
            $table->string('tfn', 20)->nullable();
            $table->unsignedFloat('payrate')->nullable();
            $table->json('store_ids')->nullable();
            $table->unsignedTinyInteger("status")->default(1)->comment("0 = Inactive, 1 = Active");
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
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
        //
        Schema::dropIfExists('user_details');

    }
}
