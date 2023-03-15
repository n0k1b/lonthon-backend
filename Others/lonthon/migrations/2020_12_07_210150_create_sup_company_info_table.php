<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupCompanyInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('sup_company_info', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('bin', 120)->nullable();
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
        Schema::dropIfExists('sup_company_info');
    }
}
