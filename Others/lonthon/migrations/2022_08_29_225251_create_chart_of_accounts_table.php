<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_class_and_type_list_id')->constrained('account_class_and_type_lists');
            $table->foreignId('parent_account_id')->nullable()->constrained('chart_of_accounts');
            $table->foreignId('tax_id')->nullable()->constrained('taxes');
            $table->string('account_name', 50);
            $table->string('description', 120)->nullable();
            $table->unsignedTinyInteger("status")->default(1)->comment("0 = Inactive, 1 = Active");
            $table->foreignId('created_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('chart_of_accounts');
    }
}
