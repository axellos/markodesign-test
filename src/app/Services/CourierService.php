<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\CourierCreateData;
use App\Dto\CourierUpdateData;
use App\Models\Courier;

class CourierService
{
    protected static bool $default_courier_state = true;

    public function store(CourierCreateData $data): Courier
    {
        $courier = Courier::query()->make([
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'phone_number' => $data->phone_number,
            'vehicle_type' => $data->vehicle_type,
            'is_active' => $data->is_active ?? static::$default_courier_state,
        ]);

        $courier->deliveryCompany()->associate($data->deliveryCompany);
        $courier->save();

        return $courier;
    }

    public function update(Courier $courier, CourierUpdateData $data): Courier
    {
        $courier->fill($data->toArray());

        if ($data->deliveryCompany !== $courier->deliveryCompany()) {
            $courier->deliveryCompany()->associate($data->deliveryCompany);
        }

        $courier->save();

        return $courier;
    }
}
