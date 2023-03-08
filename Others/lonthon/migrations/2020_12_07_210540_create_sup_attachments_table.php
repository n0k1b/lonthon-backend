<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sup_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sup_company_info_id')->constrained('sup_company_info');
            $table->string('name', 120)->nullable();
            $table->string('attachment', 120)->nullable();
            $table->string('extension', 60)->nullable();
            $table->string('size', 20)->nullable();
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
        Schema::dropIfExists('sup_attachments');
    }
}
