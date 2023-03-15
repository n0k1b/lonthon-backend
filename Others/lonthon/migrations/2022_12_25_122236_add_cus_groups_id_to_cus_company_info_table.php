<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCusGroupsIdToCusCompanyInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cus_company_info', function (Blueprint $table) {
            $table->json('cus_group_ids')->nullable()->comment("[1, 2]")->after('type');
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
            $table->dropColumn(['cus_group_ids']);
        });
    }
}
