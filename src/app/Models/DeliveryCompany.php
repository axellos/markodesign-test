<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryCompany extends Model
{
    protected $fillable = [
        'name',
        'phone_number',
        'email',
    ];

    public function couriers(): HasMany
    {
        return $this->hasMany(Courier::class);
    }
}
