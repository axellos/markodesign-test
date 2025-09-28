<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Courier;
use App\Services\CourierLocationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SyncCourierLocationsJob implements ShouldQueue
{
    use Queueable;

    public function handle(CourierLocationService $courierLocationService): void
    {
        $couriers = Courier::query()->active()->with('location')->get();

        foreach ($couriers as $courier) {
            $courierLocationService->syncCourierLocation($courier);
        }
    }
}
