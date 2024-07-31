@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Flights</h1>
    <a href="{{ route('flights.create') }}" class="btn btn-primary">Add Flight</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Destination</th>
                <th>Departure Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($flights as $flight)
            <tr>
                <td>{{ $flight->name }}</td>
                <td>{{ $flight->destination }}</td>
                <td>{{ $flight->departure_time }}</td>
                <td>
                    <a href="{{ route('flights.edit', $flight->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('flights.destroy', $flight->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
