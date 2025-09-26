<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\VehicleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'is_active',
        'vehicle_type',
        'current_lat',
        'current_lng',
        'location_updated_at',
    ];

    protected $casts = [
        'current_lat' => 'float',
        'current_lng' => 'float',
        'is_active' => 'boolean',
        'vehicle_type' => VehicleType::class,
        'location_updated_at' => 'datetime',
    ];

    public function deliveryCompany(): BelongsTo
    {
        return $this->belongsTo(DeliveryCompany::class);
    }
}
