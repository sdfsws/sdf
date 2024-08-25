<!-- resources/views/yemenia/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
    
    @component('components.yemenia-form', ['locations' => $locations])@endcomponent

        <!-- Link to view all flights -->
        <a href="{{ route('yemenia.all_flights') }}" class="btn btn-info mt-3">View All Flights for Today</a>

    </div>
@endsection
