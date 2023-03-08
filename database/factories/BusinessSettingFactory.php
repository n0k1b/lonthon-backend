<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusinessSettings>
 */
class BusinessSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'favicon' => $this->faker->imageUrl(16, 16),
            'homepage_banner_image' => $this->faker->imageUrl(640, 480),
            'homepage_title' => $this->faker->sentence,
            'homepage_description' => $this->faker->paragraph,
            'homepage_promotional_banner1' => $this->faker->imageUrl(640, 480),
            'homepage_promotional_banner2' => $this->faker->imageUrl(640, 480),
            'logo' => $this->faker->imageUrl(200, 200),
            'about_us' => $this->faker->paragraph,
            'email' => $this->faker->safeEmail,
            'contact_info1' => $this->faker->sentence,
            'contact_info2' => $this->faker->sentence,
            'contact_info3' => $this->faker->sentence,
            'facebook_url' => $this->faker->url,
            'instagram_url' => $this->faker->url,
            'twitter_url' => $this->faker->url,
            'terms_and_condition' => $this->faker->paragraph
        ];
    }
}
