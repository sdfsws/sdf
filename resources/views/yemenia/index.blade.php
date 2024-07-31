<!-- resources/views/yemenia/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Search Flight Schedule</h1>
        <form action="{{ route('yemenia.search') }}" method="get">
            <div class="form-group">
                <label for="from">From</label>
                <select name="from" id="from" required class="form-control" aria-required="true" aria-label="Select departure location">
                    <option value="">Select departure location</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->code }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="to">To</label>
                <select name="to" id="to" required class="form-control" aria-required="true" aria-label="Select arrival location">
                    <option value="">Select arrival location</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->code }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" required class="form-control" aria-required="true" aria-label="Select date">
            </div>
            <button type="submit" class="btn btn-primary">Search Flight Schedules</button>
        </form>
    <!-- Link to view all flights -->
    <a href="{{ route('yemenia.all_flights') }}" class="btn btn-info mt-3">View All Flights for Today</a>

        @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fromSelect = document.getElementById('from');
            const toSelect = document.getElementById('to');
            const options = Array.from(toSelect.options);
            
            fromSelect.addEventListener('change', function () {
                const selectedFrom = fromSelect.value;
                // Enable all options in the 'to' select
                options.forEach(option => option.disabled = false);

                // Disable the selected 'from' option in the 'to' select
                if (selectedFrom) {
                    options.forEach(option => {
                        if (option.value === selectedFrom) {
                            option.disabled = true;
                        }
                    });
                }
            });

            toSelect.addEventListener('change', function () {
                const selectedTo = toSelect.value;
                // Enable all options in the 'from' select
                Array.from(fromSelect.options).forEach(option => option.disabled = false);

                // Disable the selected 'to' option in the 'from' select
                if (selectedTo) {
                    Array.from(fromSelect.options).forEach(option => {
                        if (option.value === selectedTo) {
                            option.disabled = true;
                        }
                    });
                }
            });
        });
    </script>
@endsection
