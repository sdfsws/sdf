<!-- resources/views/googleflight/search.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flight-search-container">
        <h1 class="text-2xl font-semibold mb-4">Find Your Flight</h1>

        <form action="{{ route('googleflight.search') }}" method="GET" id="flightSearchForm">
            @csrf

            <!-- Departure and Arrival -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="flex flex-col">
                    <label for="departure_id" class="text-gray-700 mb-1">
                        <i class="fas fa-plane-departure mr-2"></i> Departing From:
                    </label>
                    <input type="text" id="departure_id" name="departure_id" aria-label="Departure City or Airport Code" value="{{ old('departure_id') }}" class="form-control rounded-md px-3 py-2" required autocomplete="off" placeholder="Enter departure city or airport code">
                    @error('departure_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>


                <div class="flex flex-col">
                    <label for="arrival_id" class="text-gray-700 mb-1">
                        <i class="fas fa-plane-arrival mr-2"></i> Arriving In:
                    </label>
                    <input type="text" id="arrival_id" name="arrival_id" aria-label="Arrival City or Airport Code" value="{{ old('arrival_id') }}" class="form-control rounded-md px-3 py-2" required autocomplete="off" placeholder="Enter arrival city or airport code">
                </div>
            </div>

            <!-- Dates -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="flex flex-col">
                    <label for="outbound_date" class="text-gray-700 mb-1">
                        <i class="fas fa-calendar-alt mr-2"></i> Outbound Date:
                    </label>
                    <input type="date" id="outbound_date" name="outbound_date" value="{{ old('outbound_date') }}" class="form-control rounded-md px-3 py-2" required>
                </div>

                <div id="return_date_div" class="flex flex-col hidden">
                    <label for="return_date" class="text-gray-700 mb-1">
                        <i class="fas fa-calendar-alt mr-2"></i> Return Date:
                    </label>
                    <input type="date" id="return_date" name="return_date" value="{{ old('return_date') }}" class="form-control rounded-md px-3 py-2">
                </div>
            </div>

            <!-- Flight Preferences -->
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">Flight Preferences:</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="flex flex-col">
                        <label for="type" class="text-gray-700 mb-1">Flight Type:</label>
                        <select id="type" name="type" class="form-control rounded-md px-3 py-2" required>
                            <option value="">Select Flight Type</option>
                            <option value="1">Round Trip</option>
                            <option value="2">One Way</option>
                            <option value="3">Multi-City</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="travel_class" class="text-gray-700 mb-1">Travel Class (optional):</label>
                        <select id="travel_class" name="travel_class" class="form-control rounded-md px-3 py-2">
                            <option value="">No Selection</option>
                            <option value="economy">Economy</option>
                            <option value="business">Business</option>
                            <option value="first">First</option>
                        </select>
                    </div>
                </div>

                <div id="multi_city_div" class="form-group mb-4 hidden">
                    <label for="multi_city_json" class="text-gray-700 mb-1">Multi-City Parameters (JSON):</label>
                    <textarea id="multi_city_json" name="multi_city_json" class="form-control rounded-md px-3 py-2" rows="3" placeholder='[{"city":"New York","date":"2024-09-01"},{"city":"Los Angeles","date":"2024-09-15"}]'>{{ old('multi_city_json') }}</textarea>
                </div>

                <div class="group mb-4">
                    <h2 class="text-xl font-semibold mb-2">Passenger Information:</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label for="number_of_passengers" class="text-gray-700 mb-1">
                                <i class="fas fa-user-friends mr-2"></i> Number of Passengers:
                            </label>
                            <div class="flex gap-2">
                                <input type="number" id="adults" name="adults" class="form-control rounded-md px-3 py-2" placeholder="Adults" min="1" value="{{ old('adults', 1) }}">
                                <input type="number" id="children" name="children" class="form-control rounded-md px-3 py-2" placeholder="Children" min="0" value="{{ old('children', 0) }}">
                                <input type="number" id="infants_in_seat" name="infants_in_seat" class="form-control rounded-md px-3 py-2" placeholder="Infants in Seat" min="0" value="{{ old('infants_in_seat', 0) }}">
                                <input type="number" id="infants_on_lap" name="infants_on_lap" class="form-control rounded-md px-3 py-2" placeholder="Infants on Lap" min="0" value="{{ old('infants_on_lap', 0) }}">
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <label for="stops" class="text-gray-700 mb-1">
                                <i class="fas fa-map-marker-alt mr-2"></i> Stops:
                            </label>
                            <select id="stops" name="stops" class="form-control rounded-md px-3 py-2">
                                <option value="">No Selection</option>
                                <option value="1">Nonstop</option>
                                <option value="2">1 Stop</option>
                                <option value="3">2+ Stops</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="group mb-4">
                    <h2 class="text-xl font-semibold mb-2">Airline Preferences:</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label for="exclude_airlines" class="text-gray-700 mb-1">
                                <i class="fas fa-ban mr-2"></i> Exclude Airlines:
                            </label>
                            <input type="text" id="exclude_airlines" name="exclude_airlines" value="{{ old('exclude_airlines') }}" class="form-control rounded-md px-3 py-2" placeholder="Enter airline codes separated by commas">
                        </div>

                        <div class="flex flex-col">
                            <label for="include_airlines" class="text-gray-700 mb-1">
                                <i class="fas fa-check mr-2"></i> Include Airlines:
                            </label>
                            <input type="text" id="include_airlines" name="include_airlines" value="{{ old('include_airlines') }}" class="form-control rounded-md px-3 py-2" placeholder="Enter airline codes separated by commas">
                        </div>
                    </div>
                </div>

                <div class="group mb-4">
                    <h2 class="text-xl font-semibold mb-2">Additional Information:</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label for="bags" class="text-gray-700 mb-1">
                                <i class="fas fa-suitcase mr-2"></i> Bags:
                            </label>
                            <input type="text" id="bags" name="bags" value="{{ old('bags') }}" class="form-control rounded-md px-3 py-2" placeholder="Enter bag details">
                        </div>

                        <div class="flex flex-col">
                            <label for="other_parameters" class="text-gray-700 mb-1">
                                <i class="fas fa-cogs mr-2"></i> Other Parameters:
                            </label>
                            <textarea id="other_parameters" name="other_parameters" class="form-control rounded-md px-3 py-2" rows="3" placeholder="Enter any other parameters">{{ old('other_parameters') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mb-4">
                <button type="submit" class="bg-blue-500 text-white rounded-md px-4 py-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    <i class="fas fa-search mr-2"></i> Search
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const returnDateDiv = document.getElementById('return_date_div');
        const multiCityDiv = document.getElementById('multi_city_div');
        const flightSearchForm = document.getElementById('flightSearchForm');

        typeSelect.addEventListener('change', function() {
            if (typeSelect.value == '1') { // Round Trip
                returnDateDiv.classList.remove('hidden');
                multiCityDiv.classList.add('hidden');
            } else if (typeSelect.value == '2') { // One Way
                returnDateDiv.classList.add('hidden');
                multiCityDiv.classList.add('hidden');
            } else if (typeSelect.value == '3') { // Multi-City
                returnDateDiv.classList.add('hidden');
                multiCityDiv.classList.remove('hidden');
            } else {
                returnDateDiv.classList.add('hidden');
                multiCityDiv.classList.add('hidden');
            }
        });
    });
</script>
@endpush
