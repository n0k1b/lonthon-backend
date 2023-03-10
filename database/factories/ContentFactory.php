<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CategorySubcategoryGenreMap;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_sub_category_map_id' => fake()->randomElement(CategorySubcategoryGenreMap::all()->pluck('id')->toArray()),
            'title' => fake()->sentence(),
            'thumbnail_image' => fake()->imageUrl(),
            'feature_image' => fake()->imageUrl(),
            'summary' => fake()->paragraph(),
            'statues' => fake()->boolean(),
            'price' => fake()->randomNumber(),
            'type' => fake()->numberBetween(0, 2),
        ];
    }
}
