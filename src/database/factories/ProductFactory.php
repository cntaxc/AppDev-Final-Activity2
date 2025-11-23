<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'productname' => $this->faker->sentence(),
            'currentinventory' => $this->faker->randomFloat(2,1, 1000),
            'averagesales' => $this->faker->randomFloat(2,1, 1000),
            'replenishdays' => $this->faker->numberBetween(1,100),
        ];
    }
}
