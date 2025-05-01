<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'name' => $this->faker->name(),
        'address' => $this->faker->address(),
        'gender' => $this->faker->randomElement(['Male', 'Female']),
        'dob' => $this->faker->date('Y-m-d', '2005-01-01'),
    ];
}

}
