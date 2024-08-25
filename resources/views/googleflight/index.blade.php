<!-- resources\views\googleflight\index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($flightsData as $flightOption)
        @foreach ($flightOption['flights'] as $flight)
            <div class="flight">
                <img src="{{ $flight['airline_logo'] }}" alt="{{ $flight['airline'] }}">
                <p><strong>Flight Number:</strong> {{ $flight['flight_number'] }}</p>
                <p><strong>Airplane:</strong> {{ $flight['airplane'] }}</p>
                <p><strong>Departure:</strong> {{ $flight['departure_airport']['name'] }} at {{ $flight['departure_airport']['time'] }}</p>
                <p><strong>Arrival:</strong> {{ $flight['arrival_airport']['name'] }} at {{ $flight['arrival_airport']['time'] }}</p>
                <p><strong>Duration:</strong> {{ $flight['duration'] }} minutes</p>
                <p><strong>Price:</strong> ${{ $flightOption['price'] }}</p>
                <p><strong>Carbon Emissions:</strong> {{ $flight['extensions'][3] }}</p>
            </div>
        @endforeach
    @endforeach
</div>
@endsection
