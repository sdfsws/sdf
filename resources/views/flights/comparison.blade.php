@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Flight Comparison</h1>
    @dd($officialFlights)

    @if (!empty($officialFlights))
        <h2 class="mb-3">Official Flights</h2>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Flight Number</th>
                    <th>Status</th>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Departure City</th>
                    <th>Arrival City</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($officialFlights as $flight)
                <tr>
                    <td>{{ $flight['flight_number'] }}</td>
                    <td>{{ $flight['status'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($flight['departure_time'])->format('H:i d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($flight['arrival_time'])->format('H:i d/m/Y') }}</td>
                    <td>{{ $flight['departure_city'] }}</td>
                    <td>{{ $flight['arrival_city'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="alert alert-warning">No flight data available.</p>
    @endif
</div>
@endsection
