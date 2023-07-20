<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'product_code' => 'BABY-'.$this->faker->postcode(),
            'price' => random_int(1000,90000),
            'stock' => random_int(0,100),
            'description' => $this->faker->paragraph(random_int(4,20)),
            'category_id' => Category::all()->random()->id,
            'from_age' => random_int(1,5),
            'to_age' => random_int(1,4),
        ];
    }
}

