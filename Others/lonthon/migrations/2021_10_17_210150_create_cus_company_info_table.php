<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCusCompanyInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cus_company_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('type')->default(1)->comment("1 = Prepaid, 2 = Credit");
            $table->string('abn', 120);
            $table->string('registered_name', 200);
            $table->json('preferred_contact')->nullable();
            $table->string('business_reg', 120)->nullable();
            $table->unsignedSmallInteger('terms')->nullable();
            $table->unsignedInteger('credit_limit')->nullable();
            $table->unsignedTinyInteger("status")->default(0)->comment("0 = Inactive, 1 = Active");
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
        Schema::dropIfExists('cus_company_info');
    }
}
