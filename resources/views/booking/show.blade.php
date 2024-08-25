<!-- resources/views/booking/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>تفاصيل الحجز</h1>
    
    <!-- Display booking details -->
    <div class="booking-details">
        <p><strong>رمز الحجز:</strong> {{ $token }}</p>
        
        <!-- Example flight details -->
        @if(isset($flight)) <!-- Check if $flight is set -->
            @php
                $flight = (object) $flight; // Convert array to object
            @endphp
            <div class="flight-info">
                <h4>تفاصيل الرحلة</h4>
                <p><strong>رقم الرحلة:</strong> {{ $flight->flight_number }}</p>
                <p><strong>مطار المغادرة:</strong> {{ $flight->departure_airport_name }}</p>
                <p><strong>مطار الوصول:</strong> {{ $flight->arrival_airport_name }}</p>
                <p><strong>وقت المغادرة:</strong> {{ $flight->departure_time }}</p>
                <p><strong>وقت الوصول:</strong> {{ $flight->arrival_time }}</p>
            </div>
        @else
            <p>لم يتم العثور على تفاصيل الرحلة.</p> <!-- Message if flight details are missing -->
        @endif

        
        <!-- Display any errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Booking form -->
        <form action="{{ route('booking.book', ['flight_id' => $flight->flight_number]) }}" method="POST">

            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="flight_token" value="{{ $flight->booking_token }}">
            <button type="submit" class="booking-button">احجز الآن</button>
        </form>

    </div>
</div>
@endsection

@push('styles')
    <style>
        .booking-details {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            background-color: #fff;
            margin-bottom: 20px;
        }
        .flight-info {
            margin-bottom: 20px;
        }
        .flight-info p {
            margin: 5px 0;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
        .booking-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            text-align: center;
        }
        .booking-button:hover {
            background-color: #0056b3;
        }
    </style>
@endpush
