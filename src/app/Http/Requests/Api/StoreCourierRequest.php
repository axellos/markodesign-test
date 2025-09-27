<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use App\Enums\VehicleType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCourierRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        if ($this->phone_number) {
            $this->merge([
                'phone_number' => preg_replace('/\D/', '', $this->phone_number),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'regex:/^\+?\d{10,15}$/', 'unique:couriers,phone_number'],
            'is_active' => ['sometimes', 'boolean'],
            'vehicle_type' => ['nullable', 'string', Rule::in(array_column(VehicleType::cases(), 'value'))],
            'delivery_company_id' => ['required', 'exists:delivery_companies,id'],
        ];
    }
}
