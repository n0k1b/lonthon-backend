<?php

namespace Database\Factories;

use App\Models\homepage_section;
use App\Models\product;
use Illuminate\Database\Eloquent\Factories\Factory;

class homepage_section_productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'homepage_section_id' => $this->faker->randomElement(homepage_section::all()->pluck('id')->toArray()),
            'product_id' => $this->faker->randomElement(product::all()->pluck('id')->toArray()),
        ];
    }
}
