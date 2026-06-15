<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $name = $this->faker->department;
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . strtolower(Str::random(6)),
            'description' => $this->faker->sentence(),
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
