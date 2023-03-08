<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCusDirectorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('cus_director_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cus_company_info_id')->constrained('cus_company_info');
            $table->foreignId('user_id')->constrained();
            $table->string('name', 120);
            $table->string('surname', 60);
            $table->date('dob')->nullable();
            $table->string('country_code', 4)->nullable();
            $table->string('calling_code', 4)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('dl_front', 120)->nullable();
            $table->string('dl_back', 120)->nullable();
            $table->string('passport', 120)->nullable();
            $table->string('utility', 120)->nullable();
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
        Schema::dropIfExists('cus_director_details');
    }
}
