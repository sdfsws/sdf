<!-- resources/views/yemenia/all_flights.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Flights for Today</h1>

    @if(count($flights) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Flight Number</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                </tr>
            </thead>
            <tbody>
                @foreach($flights as $flight)
                    <tr>
                        <td>{{ $flight['flight_number'] }}</td>
                        <td>{{ $flight['from'] }}</td>
                        <td>{{ $flight['to'] }}</td>
                        <td>{{ $flight['departure'] }}</td>
                        <td>{{ $flight['arrival'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No flights available for today.</p>
    @endif
</div>
@endsection
