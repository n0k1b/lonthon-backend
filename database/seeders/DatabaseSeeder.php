<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Subcategory::factory(5)->create();
        \App\Models\Genre::factory(5)->create();
        \App\Models\CategorySubcategoryGenreMap::factory()->create();
        \App\Models\CategorySubcategoryGenreMap::factory()->create();
        \App\Models\Content::factory(15)->create();
        \App\Models\ContentMedia::factory(15)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
