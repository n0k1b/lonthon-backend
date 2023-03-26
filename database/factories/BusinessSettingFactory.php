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
            'favicon' => "settings/favicon.ico",
            'homepage_banner_image' => "settings/homepage_banner_image.jpg",
            'homepage_title' => $this->faker->sentence,
            'homepage_description' => $this->faker->paragraph,
            'homepage_promotional_banner1' => "settings/homepage_promotional_banner1.jpg",
            'homepage_promotional_banner2' => "settings/homepage_promotional_banner2.jpg",
            'logo' => "settings/logo.png",
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
