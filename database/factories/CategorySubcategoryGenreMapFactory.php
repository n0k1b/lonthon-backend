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
            'category_id' => factory(App\Models\Category::class)->create()->id,
            'subcategory_id' => factory(App\Models\SubCategory::class)->create()->id,
            'genre_id' => factory(App\Models\Genre::class)->create()->id,
        ];
    }
}
