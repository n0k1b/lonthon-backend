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
        Schema::create('content', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_sub_category_map_id');
            $table->string('title');
            $table->string('thumbnail_image');
            $table->string('feature_image');
            $table->longText('summary');
            $table->boolean('statues')->default(false);
            $table->integer('price')->nullable();
            $table->unsignedTinyInteger('type')->comment("0 = free, 1 = paid, 2 = negotiative");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content');
    }
};
