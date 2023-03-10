<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ContentMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mediaType = fake()->numberBetween(0, 1);

        return [
            'content_id' => fake()->randomElement(Category::all()->pluck('id')->toArray()),
            'media_type' => $mediaType,
            'media_url' => $mediaType === 0 ? fake()->imageUrl() : fake()->url(),
        ];
    }
}
