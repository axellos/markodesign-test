<?php

declare(strict_types=1);

namespace App\Dto;

use App\Enums\VehicleType;
use App\Models\DeliveryCompany;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class CourierUpdateData implements Arrayable
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $phone_number,
        public bool $is_active,
        public ?VehicleType $vehicle_type,
        public DeliveryCompany $deliveryCompany,
    ) {}

    public static function fromRequest(Request $request): static
    {
        $validated = $request->validated();

        return new static(
            $validated['first_name'],
            $validated['last_name'],
            $validated['phone_number'],
            (bool) $validated['is_active'],
            isset($validated['vehicle_type']) ? VehicleType::from($validated['vehicle_type']) : null,
            DeliveryCompany::query()->find($validated['delivery_company_id']),
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'is_active' => $this->is_active,
            'vehicle_type' => $this->vehicle_type,
        ];
    }
}
