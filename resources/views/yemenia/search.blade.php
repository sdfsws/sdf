<!-- resources/views/yemenia/search.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Search for Flights</h1>
    <form action="{{ route('yemenia.search') }}" method="GET">
        <div class="form-group">
            <label for="from">Departure City</label>
            <select name="from" id="from" class="form-control" aria-label="Select departure city" required>
                <option value="">Select departure city</option>
                @foreach($departureCities as $city)
                    <option value="{{ $city->code }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="to">Destination City</label>
            <select name="to" id="to" class="form-control" aria-label="Select destination city" required>
                <option value="">Select destination city</option>
                @foreach($destinationCities as $city)
                    <option value="{{ $city->code }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="date">Travel Date</label>
            <input type="date" name="date" id="date" class="form-control" aria-required="true" required>
        </div>
        <button type="submit" class="btn btn-primary">Search Flights</button>
    </form>

    <!-- Add a button to go back to the main page -->
    <a href="{{ route('yemenia.index') }}" class="btn btn-secondary mt-3">Back to Main Page</a>
</div>
@endsection
