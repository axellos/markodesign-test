<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateCourierLocationRequest;
use App\Http\Resources\CourierLocationResource;
use App\Models\Courier;
use App\Services\CourierLocationService;
use Illuminate\Http\Resources\Json\JsonResource;

class CourierLocationController extends Controller
{
    public function __construct(
        private readonly CourierLocationService $courierLocationService
    ) {}

    public function index(): JsonResource
    {
        return CourierLocationResource::collection($this->courierLocationService->getAllCourierLocations());
    }

    public function update(UpdateCourierLocationRequest $request, Courier $courier): void
    {
        $this->courierLocationService->updateLocation(
            $courier,
            (float) $request->validated()['lat'],
            (float) $request->validated()['lng']
        );
    }
}
