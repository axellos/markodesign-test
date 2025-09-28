<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Courier;
use App\Observers\CourierObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Courier::observe(CourierObserver::class);
    }
}
