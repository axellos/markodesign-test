@extends('layouts.app')

@section('title', 'Courier Map')

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>

    <h2 class="text-2xl font-bold mb-4">Courier Map</h2>

    <div id="map" class="w-full h-[80vh] rounded shadow mb-4"></div>
@endsection
