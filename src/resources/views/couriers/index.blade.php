@extends('layouts.app')

@section('title', 'Couriers')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Couriers</h2>

    <a href="#" class="inline-block mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
        Add New Courier
    </a>

    <table class="min-w-full bg-white rounded shadow overflow-hidden">
        <thead class="bg-gray-200">
        <tr>
            <th class="p-2 text-left w-1/12">ID</th>
            <th class="p-2 text-left w-1/6">First Name</th>
            <th class="p-2 text-left w-1/6">Last Name</th>
            <th class="p-2 text-left w-1/6">Phone</th>
            <th class="p-2 text-left w-1/12">Active</th>
            <th class="p-2 text-left w-1/6">Vehicle</th>
            <th class="p-2 text-left w-1/6">Company</th>
            <th class="p-2 text-left w-1/12">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($couriers as $courier)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-2">{{ $courier->id }}</td>
                <td class="p-2">{{ $courier->first_name }}</td>
                <td class="p-2">{{ $courier->last_name }}</td>
                <td class="p-2">{{ $courier->phone_number }}</td>
                <td class="p-2">
                    @if($courier->is_active)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    @endif
                </td>
                <td class="p-2">{{ $courier->vehicle_type_label }}</td>
                <td class="p-2">{{ $courier->deliveryCompany->name }}</td>
                <td class="p-2 flex space-x-3 items-center">
                    <a href="#" class="text-blue-500 hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>

                    </a>
                    <form action="#" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $couriers->links() }}
    </div>
@endsection
