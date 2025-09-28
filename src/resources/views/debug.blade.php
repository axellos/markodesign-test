@extends('layouts.app')

@section('title', 'Courier Debug')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Courier Debug</h2>

    <div class="space-y-4 bg-white p-6 rounded shadow-md">
        <form class="mb-4" onsubmit="handleLocationUpdateFormSubmit(event)">
            <div class="mb-4">
                <label for="courier_id" class="block mb-1 font-semibold">Courier:</label>
                <select id="courier_id" required name="courier_id" class="w-full p-2 border rounded">
                    @foreach($couriers as $courier)
                        <option value="{{ $courier->id }}">
                            {{ $courier->first_name }} {{ $courier->last_name }} (ID: {{ $courier->id }})
                        </option>
                    @endforeach
                </select>
                <div class="text-red-500 text-sm mt-1" id="error_courier_id"></div>
            </div>

            <div class="mb-4">
                <label for="lat" class="block mb-1 font-semibold">Latitude:</label>
                <input type="text" id="lat" name="lat" class="w-full p-2 border rounded text-sm">
                <div class="text-red-500 text-sm mt-1" id="error_lat"></div>
            </div>

            <div class="mb-4">
                <label for="lng" class="block mb-1 font-semibold">Longitude:</label>
                <input type="text" id="lng" name="lng" class="w-full p-2 border rounded text-sm">
                <div class="text-red-500 text-sm mt-1" id="error_lng"></div>
            </div>

            <button id="send-location" type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                Send Test Location
            </button>
        </form>

        <h2 class="text-xl font-bold mt-6 mb-2">WebSocket Events</h2>
        <div id="ws-log" class="border p-4 rounded h-64 overflow-y-scroll bg-gray-50 w-full max-w-xl"></div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/debug.js')
@endpush
