<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\CourierLocation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin CourierLocation */
class CourierLocationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
