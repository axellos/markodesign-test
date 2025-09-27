<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\CourierLocationUpdated;
use App\Models\Courier;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Redis\Connection;

readonly class CourierLocationService
{
    public function __construct(
        private Connection $redis,
        private Dispatcher $eventManager,
    ) {}

    public function updateLocation(Courier $courier, float $lat, float $lng): void
    {
        $key = "courier:{$courier->id}:location";
        $data = json_encode([
            'lat' => $lat,
            'lng' => $lng,
            'updated_at' => now()->toDateTimeString(),
        ]);

        $this->redis->set($key, $data);
        $this->eventManager->dispatch(new CourierLocationUpdated($courier->id, $lat, $lng));
    }

    public function getLocation(Courier $courier): ?array
    {
        $key = "courier:{$courier->id}:location";
        $data = $this->redis->get($key);

        return $data ? json_decode($data, true) : null;
    }
}
