<?php

namespace Database\Factories\Advertisment;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AdvertismentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(1),
            'description' => $this->faker->paragraph(1),
            'created_at' => $this->faker->dateTimeBetween('-2 year', '-1 year'),
            'updated_at' => $this->faker->dateTimeBetween('now', 'now'),
            'expires_at' => $this->faker->dateTimeBetween('-1 day', '+1 day'),
            'type' => $this->faker->randomElement(['sell', 'rent']),
            'user_id' => '1',
        ];
    }
}
