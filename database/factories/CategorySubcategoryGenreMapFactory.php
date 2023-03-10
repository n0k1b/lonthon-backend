<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategorySubcategoryGenreMapFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => fake()->randomElement(\App\Models\Category::all()->pluck('id')->toArray()),
            'subcategory_id' => fake()->randomElement(\App\Models\SubCategory::all()->pluck('id')->toArray()),
            'genre_id' => fake()->randomElement(\App\Models\Genre::all()->pluck('id')->toArray()),
        ];
    }
}
