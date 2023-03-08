<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCusContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cus_contact_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cus_company_info_id')->constrained('cus_company_info');
            $table->string('name', 120)->nullable();
            $table->string('role', 60)->nullable();
            $table->string('country_code', 4)->nullable();
            $table->string('calling_code', 4)->nullable();
            $table->string('mobile', 20)->nullable();
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
        Schema::dropIfExists('cus_contact_details');
    }
}
