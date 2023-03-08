<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('business_settings', function (Blueprint $table) {
            $table->id();
            $table->string('favicon')->nullable();
            $table->string('homepage_banner_image')->nullable();
            $table->string('homepage_title')->nullable();
            $table->text('homepage_description')->nullable();
            $table->string('homepage_promotional_banner1')->nullable();
            $table->string('homepage_promotional_banner2')->nullable();
            $table->string('logo')->nullable();
            $table->text('about_us')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_info1')->nullable();
            $table->string('contact_info2')->nullable();
            $table->string('contact_info3')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->text('terms_and_condition')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_settings');
    }
};
