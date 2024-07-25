<!-- resources/views/flights/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Flight</h1>

    <!-- Display success message if exists -->
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('flights.update', $flight->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name" class="form-label">Flight Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $flight->name) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="departure" class="form-label">Departure</label>
            <input type="text" class="form-control" id="departure" name="departure" value="{{ old('departure', $flight->departure) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="destination" class="form-label">Destination</label>
            <input type="text" class="form-control" id="destination" name="destination" value="{{ old('destination', $flight->destination) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="departure_time" class="form-label">Departure Time</label>
            <input type="datetime-local" class="form-control" id="departure_time" name="departure_time" value="{{ old('departure_time', \Carbon\Carbon::parse($flight->departure_time)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Flight</button>
    </form>
</div>
@endsection
