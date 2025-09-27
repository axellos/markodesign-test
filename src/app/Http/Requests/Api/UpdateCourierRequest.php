<?php

declare(strict_types=1);

namespace App\Http\Requests\Api;

use App\Enums\VehicleType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourierRequest extends FormRequest
{
    use NormalizesPhone;

    public function prepareForValidation(): void
    {
        $this->preparePhoneNumber();
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'regex:/^\+?\d{10,15}$/', Rule::unique('couriers', 'phone_number')->ignore($this->courier->id)],
            'is_active' => ['required', 'boolean'],
            'vehicle_type' => ['nullable', 'string', Rule::in(array_column(VehicleType::cases(), 'value'))],
            'delivery_company_id' => ['required', 'exists:delivery_companies,id'],
        ];
    }
}
