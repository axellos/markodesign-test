<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Courier;
use App\Models\DeliveryCompany;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DeliveryCompany::factory()
            ->count(5)
            ->has(Courier::factory()->count(20))
            ->create();
    }
}
