<?php

namespace Database\Factories;

use App\Models\category;
use App\Models\product_dietary;
use App\Models\product_type;
use App\Models\product_ingredient;
use App\Models\product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = product::class;
    public function definition()
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($this->faker));
        return [
            //
            'vendor_id' => 1,
            'category_id' => $this->faker->randomElement(category::all()->pluck('id')->toArray()),
            'product_type' => $this->faker->randomElement(product_type::all()->pluck('name')->toArray()), // password
            'product_ingredients'=>$this->faker->randomElement(product_ingredient::all()->pluck('name')->toArray()),
            'product_dietaries'=>$this->faker->randomElement(product_dietary::all()->pluck('name')->toArray()),
            'thumbnail_image'=>$this->faker->randomElement(['image/product/1.png','image/product/2.png','image/product/3.png','image/product/4.png','image/product/5.png','image/product/6.png']),
            'detail_image1'=>$this->faker->randomElement(['image/product/1.png','image/product/2.png','image/product/3.png','image/product/4.png','image/product/5.png','image/product/6.png']),
            'detail_image2'=>$this->faker->randomElement(['image/product/1.png','image/product/2.png','image/product/3.png','image/product/4.png','image/product/5.png','image/product/6.png']),
            'detail_image3'=>$this->faker->randomElement(['image/product/1.png','image/product/2.png','image/product/3.png','image/product/4.png','image/product/5.png','image/product/6.png']),
            'price'=>$this->faker->numberBetween(20,100),
            'product_description'=>$this->faker->text(300),
            'name'=>$this->faker->foodName()
        ];
    }
}
