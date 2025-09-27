<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Courier Service')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

<nav class="w-64 bg-white shadow-md p-6">
    <h1 class="text-xl font-bold mb-6">Courier Service</h1>
    <ul class="space-y-3">
        <li>
            <a href="{{ route('couriers.index') }}"
               class="block p-2 rounded hover:bg-gray-200
                      {{ request()->routeIs('couriers.*') ? 'bg-gray-300 font-semibold' : '' }}">
                Couriers
            </a>
        </li>
        <li><a href="#" class="block p-2 rounded hover:bg-gray-200">Map</a></li>
        <li><a href="#" class="block p-2 rounded hover:bg-gray-200">Debug</a></li>
    </ul>
</nav>

<main class="flex-1 p-8">
    @yield('content')
</main>

</body>
</html>
