<!-- resources/views/yemenia/results.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>نتائج بحث الرحلات</h1>

    @if(isset($flights) && is_array($flights) && count($flights) > 0)
        <div class="table-responsive">
            <table class="table table-striped border-top">
                <thead class="thead-">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">From - To:</th>
                        <th scope="col">Departure</th>
                        <th scope="col">Arrival</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flights as $flight)
                        @php
                            $departureDateTime = cleanDate($flight['departure']);
                            $arrivalDateTime = cleanDate($flight['arrival']);
                        @endphp
                        <tr>
                            <td scope="row"><strong class="font-size-2">{{ $flight['flight_number'] }}</strong></td>
                            <td>
                                <p>
                                {{ $flight['from'] }}
                                <i class="fa fa-plane-departure px-2 text-muted" style="font-size: 15px" aria-hidden="true"></i>
                                {{ $flight['to'] }}
                            </p>
                            </td>
                            <td>
                                <p>
                                    @if($departureDateTime && $departureDateTime !== 'N/A')
                                        {{ $departureDateTime }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </td>
                            <td>
                                <p>
                                    @if($arrivalDateTime && $arrivalDateTime !== 'N/A')
                                        {{ $arrivalDateTime }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </td>
                            <td>

                            @if(auth()->check())
                                <form action="{{ route('desired_flights.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="flight_id" value="{{ $flight['flight_number'] }}">
                                    <button type="submit" class="btn btn-primary">أضف إلى قائمة الرحلات المطلوبة</button>
                                </form>
                            @else
                                <button class="btn btn-primary" onclick="window.location.href='{{ route('login', ['flight_id' => $flight['flight_number']]) }}'">تسجيل الدخول لإضافة الرحلة</button>
                            @endif


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning mt-3">
            <strong>لا توجد رحلات متاحة للمعايير المحددة.</strong><br>
            يرجى المحاولة مرة أخرى مع معايير مختلفة.
        </div>
    @endif

    <a href="{{ route('yemenia.index') }}" class="btn btn-secondary mt-3">العودة إلى البحث</a>
</div>
@endsection
