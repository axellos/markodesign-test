<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\CourierLocationUpdated;
use App\Models\Courier;
use App\Models\CourierLocation;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Redis\Connection;
use Illuminate\Support\Collection;

readonly class CourierLocationService
{
    public function __construct(
        private Connection $redis,
        private Dispatcher $eventManager,
    ) {}

    public function updateLocation(Courier $courier, float $lat, float $lng): void
    {
        $data = json_encode([
            'lat' => $lat,
            'lng' => $lng,
            'updated_at' => now()->toDateTimeString(),
        ]);

        $this->redis->set($this->getRedisKey($courier->id), $data);
        $this->eventManager->dispatch(new CourierLocationUpdated($courier->id, $lat, $lng));
    }

    public function setLocation(CourierLocation $location): void
    {
        $data = json_encode([
            'lat' => $location->lat,
            'lng' => $location->lng,
            'updated_at' => $location->updated_at,
        ]);

        $this->redis->set($this->getRedisKey($location->courier_id), $data);
        $this->eventManager->dispatch(
            new CourierLocationUpdated($location->courier_id, $location->lat, $location->lng)
        );
    }

    public function getLocation(Courier $courier): ?CourierLocation
    {
        $data = $this->redis->get($this->getRedisKey($courier->id));

        return $data
            ? CourierLocation::make()->forceFill([
                ...json_decode($data, true),
                'courier_id' => $courier->id,
            ])
            : null;
    }

    public function syncCourierLocation(Courier $courier): void
    {
        $location = $this->getLocation($courier);

        if ($location === null && $courier->location !== null) {
            $this->setLocation($courier->location);

            return;
        }

        if ($location === null) {
            return;
        }

        if ($courier->location !== null) {
            $courier->location()->update([
                'lat' => $location->lat,
                'lng' => $location->lng,
                'synced_at' => $location->updated_at,
            ]);
        } else {
            $courier->location()->create([
                'lat' => $location->lat,
                'lng' => $location->lng,
                'synced_at' => $location->updated_at,
            ]);
        }
    }

    public function getAllCourierLocations(): Collection
    {
        return Courier::query()->active()->with('location')->get()->map(function (Courier $courier) {
            return $this->getLocation($courier);
        })->filter();
    }

    public function getRedisKey(int $courierId): string
    {
        return "courier:{$courierId}:location";
    }
}
