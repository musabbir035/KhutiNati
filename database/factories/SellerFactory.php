<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SellerFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->text(30),
            'description' => $this->faker->boolean(60) ? $this->faker->text(200) : null,
            'address' => $this->faker->boolean(80) ? $this->faker->text(100) : null,
            'mobile' => '01' . $this->faker->numerify('#########'),
            'email' => $this->faker->boolean(50) ? $this->faker->safeEmail() : null,
            'image' => $this->faker->boolean(80)
                ? $this->faker->image(storage_path('app\public\images\sellers'), 400, 400, null, false)
                : null,
        ];
    }
}
