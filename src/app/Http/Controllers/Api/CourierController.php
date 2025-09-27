<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Dto\CourierCreateData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCourierRequest;
use App\Http\Resources\CourierResource;
use App\Models\Courier;
use App\Services\CourierService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class CourierController extends Controller
{
    use WithPerPage;

    public function __construct(
        private readonly CourierService $courierService
    ) {}

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

    public function store(StoreCourierRequest $request): JsonResponse
    {
        $courier = $this->courierService->store(CourierCreateData::fromRequest($request));

        return response()->json(CourierResource::make($courier), Response::HTTP_CREATED);
    }
}
