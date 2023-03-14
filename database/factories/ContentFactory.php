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
            'feature_image' => fake()->randomElement(["image-1.jpg","image-2.jpg","image-3.jpg","image-4.jpg","image-5.jpg","image-6.jpg","image-7.jpg"]),
            'summary' => fake()->paragraph(),
            'statues' => fake()->boolean(),
            'price' => fake()->randomNumber(4),
            'type' => fake()->numberBetween(0, 2),
        ];
    }
}
