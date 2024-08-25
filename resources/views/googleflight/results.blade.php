<!-- resources/views/googleflight/results.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($flights as $flight)
            <div class="flight-card">
                <h3>الرحلة {{ $loop->iteration }}</h3>

                <div class="flight-details">
                    <div>
                        <h4>رحلة من {{ $flight['flights'][0]['departure_airport']['name'] ?? 'غير محدد' }} إلى {{ $flight['flights'][0]['arrival_airport']['name'] ?? 'غير محدد' }}</h4>
                        <p><strong>الطائرة:</strong> {{ $flight['flights'][0]['airplane'] ?? 'غير محدد' }}</p>
                        <p><strong>الدرجة:</strong> {{ $flight['flights'][0]['travel_class'] ?? 'غير محدد' }}</p>
                        <p><strong>رقم الرحلة:</strong> {{ $flight['flights'][0]['flight_number'] ?? 'غير محدد' }}</p>
                        <p><strong>الوقت الكلي:</strong> {{ $flight['total_duration'] ?? 'غير محدد' }} دقيقة</p>
                        <p><strong>السعر:</strong> {{ $flight['price'] ?? 'غير محدد' }} USD</p>
                    </div>
                    
                    <div>
                        <h4>تفاصيل الرحلات</h4>
                        @foreach($flight['flights'] as $flightDetail)
                            <p><strong>مطار المغادرة:</strong> {{ $flightDetail['departure_airport']['name'] ?? 'غير محدد' }} ({{ $flightDetail['departure_airport']['id'] ?? 'غير محدد' }}, {{ $flightDetail['departure_airport']['time'] ?? 'غير محدد' }})</p>
                            <p><strong>مطار الوصول:</strong> {{ $flightDetail['arrival_airport']['name'] ?? 'غير محدد' }} ({{ $flightDetail['arrival_airport']['id'] ?? 'غير محدد' }}, {{ $flightDetail['arrival_airport']['time'] ?? 'غير محدد' }})</p>
                            <p><strong>مدة الرحلة:</strong> {{ $flightDetail['duration'] ?? 'غير محدد' }} دقيقة</p>
                            <p><strong>شركة الطيران:</strong> 
                                @if(!empty($flightDetail['airline_logo']))
                                    <img src="{{ $flightDetail['airline_logo'] }}" alt="{{ $flightDetail['airline'] ?? 'غير محدد' }}"> 
                                @endif
                                {{ $flightDetail['airline'] ?? 'غير محدد' }}
                            </p>
                            <p><strong>مساحة الأرجل:</strong> {{ $flightDetail['legroom'] ?? 'غير محدد' }}</p>
                            <p><strong>الملحقات:</strong> {{ implode(', ', $flightDetail['extensions'] ?? []) }}</p>
                        @endforeach
                    </div>
                </div>

                <div class="layovers">
                    <h4>محطات التوقف</h4>
                    <ul>
                        @forelse($flight['layovers'] ?? [] as $layover)
                            <li>
                                <p><strong>اسم المحطة:</strong> {{ $layover['name'] ?? 'غير محدد' }}</p>
                                <p><strong>مدة التوقف:</strong> {{ $layover['duration'] ?? 'غير محدد' }} دقيقة</p>
                                @if(!empty($layover['overnight']))
                                    <p><strong>التوقف ليلاً:</strong> نعم</p>
                                @endif
                            </li>
                        @empty
                            <li>لا توجد محطات توقف</li>
                        @endforelse
                    </ul>
                </div>

                <div class="carbon-emissions">
                    <h4>الانبعاثات الكربونية</h4>
                    <ul>
                        <li><strong>الانبعاثات لهذه الرحلة:</strong> {{ $flight['carbon_emissions']['this_flight'] ?? 'غير محدد' }} جرام</li>
                        <li><strong>المعدل المعتاد لهذا المسار:</strong> {{ $flight['carbon_emissions']['typical_for_this_route'] ?? 'غير محدد' }} جرام</li>
                        <li><strong>الفرق المئوي:</strong> {{ $flight['carbon_emissions']['difference_percent'] ?? 'غير محدد' }}%</li>
                    </ul>
                </div>
                <!-- Button to view the flight details -->
                <form action="{{ route('booking.show') }}" method="GET">
                    <input type="hidden" name="flight_token" value="{{ $flight['booking_token'] }}">
                    <button type="submit" class="view-flight-button">عرض تفاصيل الرحلة</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection

@push('styles')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .flight-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fff;
        }
        .flight-card img {
            max-width: 70px;
            vertical-align: middle;
        }
        .flight-card h3 {
            margin: 0;
        }
        .flight-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .flight-details div {
            width: 48%;
        }
        .flight-details div p {
            margin: 5px 0;
        }
        .price {
            font-size: 1.2em;
            font-weight: bold;
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
        .layovers, .carbon-emissions {
            margin: 20px 0;
        }
        .layovers ul, .carbon-emissions ul {
            list-style: none;
            padding: 0;
        }
        .layovers li, .carbon-emissions li {
            background: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
@endpush
