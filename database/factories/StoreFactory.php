<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
             $name = $this->faker->unique()->word();
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . strtolower(Str::random(6)),
            'description' => $this->faker->sentence(),
            'logo_image' => $this->faker->imageUrl(300, 300, 'business'),
            'cover_image' => $this->faker->imageUrl(800, 400, 'business'),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
