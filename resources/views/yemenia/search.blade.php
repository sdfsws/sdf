<!-- resources/views/yemenia/search.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Search for Flights</h1>
    <form action="{{ route('yemenia.search') }}" method="GET">
        <div class="form-group">
            <label for="departure_city">Departure City</label>
            <select name="departure_city" id="departure_city" class="form-control" aria-label="Select departure city" required>
                @foreach($departureCities as $city)
                    <option value="{{ $city->code }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="destination_city">Destination City</label>
            <select name="destination_city" id="destination_city" class="form-control" aria-label="Select destination city" required>
                @foreach($destinationCities as $city)
                    <option value="{{ $city->code }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="travel_date">Travel Date</label>
            <input type="date" name="travel_date" id="travel_date" class="form-control" aria-required="true" required>
        </div>
        <button type="submit" class="btn btn-primary">Search Flights</button>
    </form>

    @if(session('error'))
        <div class="alert alert-danger mt-3">
            <strong>Error:</strong> {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success mt-3">
            <strong>Success:</strong> {{ session('success') }}
        </div>
    @endif
</div>
@endsection
