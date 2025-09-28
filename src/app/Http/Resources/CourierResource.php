<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Courier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Courier */
class CourierResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'is_active' => $this->is_active,
            'vehicle_type' => $this->vehicle_type,
            'delivery_company' => new DeliveryCompanyResource($this->deliveryCompany),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
