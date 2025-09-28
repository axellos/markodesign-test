<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourierLocation extends Model
{
    protected $fillable = [
        'lat',
        'lng',
        'synced_at',
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'synced_at' => 'datetime',
    ];

    public function courier(): BelongsTo
    {
        return $this->belongsTo(Courier::class);
    }
}
