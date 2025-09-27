<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\VehicleType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourierFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vehicleTypes = VehicleType::cases();

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone_number' => $this->faker->unique()->numerify('380#########'),
            'is_active' => $this->faker->boolean(95),
            'vehicle_type' => $vehicleTypes[array_rand($vehicleTypes)],
        ];
    }
}
