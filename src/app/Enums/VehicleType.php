<?php

declare(strict_types=1);

namespace App\Enums;

enum VehicleType: string
{
    case BICYCLE = 'bicycle';
    case CAR = 'car';
    case SCOOTER = 'scooter';

    public function label(): string
    {
        return __('enums.'.self::class.'.'.$this->value);
    }
}
