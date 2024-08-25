<!-- resources/views/yemenia/all_flights.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Flights for Today</h1>

    @if(isset($flights['error']))
        <p class="text-danger">Error: {{ $flights['error'] }}</p>
    @else
        @if(is_array($flights) && !empty($flights))
            <table class="table table-striped border-top">
                <thead>
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
                    @foreach($flights as $flight)
                        <tr>
                            <td>{{ $flight['flight_number'] ?? 'N/A' }}</td>
                            <td>{{ $flight['status'] ?? 'N/A' }}</td>
                            <td>
                                @if(isset($flight['departure_time']))
                                    {{ $flight['departure_time']['time'] ?? 'N/A' }}<br>
                                    {{ $flight['departure_time']['date'] ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if(isset($flight['arrival_time']))
                                    {{ $flight['arrival_time']['time'] ?? 'N/A' }}<br>
                                    {{ $flight['arrival_time']['date'] ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $flight['departure_city'] ?? 'N/A' }}</td>
                            <td>{{ $flight['arrival_city'] ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No flights available for today.</p>
        @endif
    @endif
</div>
@endsection
