<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sup_contact_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sup_company_info_id')->constrained('sup_company_info');
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
        Schema::dropIfExists('sup_contact_details');
    }
}
