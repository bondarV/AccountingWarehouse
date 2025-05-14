<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private function getArbitraryCost() : callable{
       return fn (array $attributes) => $attributes['price'] - rand(0, 100);
    }
    public function definition(): array
    {
        return [
            'name' => fake()->words(rand(1,4), true),
            'description' => fake()->text(300),
            'price' => fake()->randomFloat(2, 100, 1000),
            'cost' => $this->getArbitraryCost(),
        ];
    }

}
