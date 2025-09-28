<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\VehicleType;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'is_active',
        'vehicle_type',
    ];

    protected $casts = [
        'current_lat' => 'float',
        'current_lng' => 'float',
        'is_active' => 'boolean',
        'vehicle_type' => VehicleType::class,
    ];

    public function deliveryCompany(): BelongsTo
    {
        return $this->belongsTo(DeliveryCompany::class);
    }

    public function location(): HasOne
    {
        return $this->hasOne(CourierLocation::class);
    }

    protected function vehicleTypeLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->vehicle_type->label()
        );
    }

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('is_active', true);
    }
}
