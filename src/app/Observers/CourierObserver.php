<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Courier;
use App\Services\CourierLocationService;

readonly class CourierObserver
{
    public function __construct(
        private CourierLocationService $courierLocationService,
    ) {}

    public function deleted(Courier $courier): void
    {
        $this->courierLocationService->deleteLocation($courier);
    }
}
