<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvailableLimitToCusCompanyInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cus_company_info', function (Blueprint $table) {
            //
            $table->decimal('available_limit', 15, 4)->nullable()->after('credit_limit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cus_company_info', function (Blueprint $table) {
            //
            $table->dropColumn(['available_limit']);
        });
    }
}
