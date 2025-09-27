<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

trait NormalizesPhone
{
    protected function preparePhoneNumber(string $field = 'phone_number'): void
    {
        if ($this->has($field) && $this->$field) {
            $this->merge([
                $field => preg_replace('/\D/', '', $this->$field),
            ]);
        }
    }
}
