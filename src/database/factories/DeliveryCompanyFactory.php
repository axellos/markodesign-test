<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryCompanyFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'phone_number' => $this->faker->unique()->numerify('380#########'),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
