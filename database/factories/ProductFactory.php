<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition()
    {
        $price = rand(1, 1000);
        $name = $this->faker->text(50);

        return [
            'name' => $name,
            'description' => $this->faker->boolean(50) ? $this->faker->text(200) : null,
            'unit' => $this->faker->word(1),
            'price' => $price,
            'discounted_price' => $this->faker->boolean(50) ?  rand(0, $price) : null,
            'image' => $this->faker->image(storage_path('app\public\images\products'), 400, 400, null, false),
            'is_featured' => $this->faker->boolean(10) ? 1 : 2,
            'inventory' => rand(0, 200),
            'slug' => Str::slug($name),
        ];
    }
}
