<!-- resources/views/flights/search.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Search Results</h2>

    @if($flights->isEmpty())
        <p>No flights found for your search criteria.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Departure</th>
                    <th>Destination</th>
                    <th>Departure Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($flights as $flight)
                <tr>
                    <td>{{ $flight->name }}</td>
                    <td>{{ $flight->departure }}</td>
                    <td>{{ $flight->destination }}</td>
                    <td>{{ $flight->departure_time }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ url('/') }}" class="btn btn-secondary">Back to Search</a>
</div>
@endsection
