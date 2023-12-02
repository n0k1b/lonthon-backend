<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->after('user_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('subcategory_id')->after('category_id');
            $table->foreign('subcategory_id')->references('id')->on('categories');

            $table->unsignedBigInteger('genre_id')->after('subcategory_id');
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->dropColumn('category_sub_category_map_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contents', function (Blueprint $table) {
            //
        });
    }
};
