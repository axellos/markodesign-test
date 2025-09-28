<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\View\View;

class CourierLocationController extends Controller
{
    public function map(): View
    {
        return view('map');
    }

    public function debug(): View
    {
        $couriers = Courier::query()->active()->get();

        return view('debug', compact('couriers'));
    }
}
