<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //$users = User::where('role','vendor')->get()->pluck('id')->toArray();
        //$cateogry = ;
        return [
            //
            'vendor_id' =>3,
            'name' => $this->faker->unique()->randomElement(['Home Made','Fast Food','Halal Food','Deserts','Sandwich','Pizza','Rice','Juice','Salad','Chicken','Noodles']),

        ];
    }
}
