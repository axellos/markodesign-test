<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\VehicleType;
use App\Models\Courier;
use App\Models\DeliveryCompany;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourierController extends Controller
{
    use WithPerPage;

    public function index(Request $request): View
    {
        $couriers = Courier::query()
            ->with('deliveryCompany')
            ->paginate($this->getPerPage($request));

        return view('couriers.index', compact('couriers'));
    }

    public function create(): View
    {
        $deliveryCompanies = DeliveryCompany::query()->get();
        $vehicleTypes = VehicleType::cases();

        return view('couriers.create', compact('deliveryCompanies', 'vehicleTypes'));
    }
}
