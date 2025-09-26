<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourierResource;
use App\Models\Courier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourierController extends Controller
{
    use WithPerPage;

    public function index(Request $request): JsonResource
    {
        $request->validate([
            'per_page' => 'integer:max:100',
        ]);

        return CourierResource::collection(
            Courier::query()
                ->with('deliveryCompany')
                ->paginate($this->getPerPage($request))
        );
    }

    public function show(Courier $courier): JsonResource
    {
        return CourierResource::make($courier);
    }
}
