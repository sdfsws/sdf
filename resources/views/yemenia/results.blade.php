@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Flight Search Results</h1>

    @if(isset($flights) && count($flights) > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
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
        </div>
    @else
        <div class="alert alert-warning mt-3">
            <strong>No flights found for the selected criteria.</strong><br>
            Please try again with different parameters.
        </div>
    @endif
</div>
@endsection
