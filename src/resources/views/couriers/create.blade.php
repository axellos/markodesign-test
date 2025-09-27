@extends('layouts.app')

@section('title', 'Add Courier')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Add Courier</h2>

    <form onsubmit="handleCourierFormSubmit(event, 'POST', '/api/couriers', 'Courier created successfully!', '/')" class="space-y-4 bg-white p-6 rounded shadow-md">
        <div>
            <label class="block mb-1">First Name</label>
            <input type="text" name="first_name" class="w-full p-2 border rounded">
            <div class="text-red-500 text-sm mt-1" id="error_first_name"></div>
        </div>

        <div>
            <label class="block mb-1">Last Name</label>
            <input type="text" name="last_name" class="w-full p-2 border rounded">
            <div class="text-red-500 text-sm mt-1" id="error_last_name"></div>
        </div>

        <div>
            <label class="block mb-1">Phone Number</label>
            <input type="text" name="phone_number" class="w-full p-2 border rounded">
            <div class="text-red-500 text-sm mt-1" id="error_phone_number"></div>
        </div>

        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" class="mr-2">
                Active
            </label>
            <div class="text-red-500 text-sm mt-1" id="error_is_active"></div>
        </div>

        <div>
            <label class="block mb-1">Vehicle Type</label>
            <select name="vehicle_type" class="w-full p-2 border rounded">
                @foreach($vehicleTypes as $type)
                    <option value="{{ $type->value }}">
                        {{ $type->label() }}
                    </option>
                @endforeach
            </select>
            <div class="text-red-500 text-sm mt-1" id="error_vehicle_type"></div>
        </div>

        <div>
            <label class="block mb-1">Delivery Company</label>
            <select name="delivery_company_id" class="w-full p-2 border rounded">
                @foreach($deliveryCompanies as $company)
                    <option value="{{ $company->id }}">
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            <div class="text-red-500 text-sm mt-1" id="error_delivery_company_id"></div>
        </div>

        <button type="submit" class="px-4 py-2 bg-green-700 text-white rounded hover:bg-green-600">Create</button>
    </form>
@endsection
