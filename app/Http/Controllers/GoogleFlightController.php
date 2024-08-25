<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleFlightController extends Controller
{
    public function search(Request $request)
    {
        // Validate request parameters
        $validated = $request->validate([
            'departure_id' => 'required|string',
            'arrival_id' => 'required|string',
            'gl' => 'nullable|string|max:2',
            'hl' => 'nullable|string|max:2',
            'currency' => 'nullable|string|max:3',
            'type' => 'nullable|in:1,2,3',
            'outbound_date' => 'nullable|date_format:Y-m-d',
            'return_date' => 'nullable|date_format:Y-m-d',
            'travel_class' => 'nullable|in:1,2,3,4',
            'multi_city_json' => 'nullable|string',
            'show_hidden' => 'nullable|boolean',
            'adults' => 'nullable|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'infants_in_seat' => 'nullable|integer|min:0',
            'infants_on_lap' => 'nullable|integer|min:0',
            'stops' => 'nullable|in:0,1,2,3',
            'exclude_airlines' => 'nullable|string',
            'include_airlines' => 'nullable|string',
            'bags' => 'nullable|integer|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'outbound_times' => 'nullable|string',
            'return_times' => 'nullable|string',
            'emissions' => 'nullable|in:1',
            'layover_duration' => 'nullable|string',
            'exclude_conns' => 'nullable|string',
            'max_duration' => 'nullable|integer|min:0',
        ]);

        // Collect parameters with defaults
        $params = array_merge([
            'engine' => 'google_flights',
            'type' => $request->input('type', 1),
            'show_hidden' => $request->boolean('show_hidden') ? 'true' : 'false',
            'no_cache' => $request->boolean('no_cache') ? 'true' : 'false',
            'api_key' => env('SERPAPI_API_KEY'),
        ], $validated);

        // Add booking_token if available
        if ($request->filled('booking_token')) {
            $params['booking_token'] = $request->input('booking_token');
        }

        try {
            // Send the request to SerpAPI
            $response = Http::get('https://serpapi.com/search.json', $params);

            if ($response->failed()) {
                Log::error('Google Flights API Request Failed', [
                    'status_code' => $response->status(),
                    'body' => $response->body(),
                    'params' => $params
                ]);

                return response()->json([
                    'error' => $response->body(),
                    'status_code' => $response->status(),
                ], $response->status());
            }

            $responseData = $response->json();
            Log::info('Google Flights API Response', ['data' => $responseData]);

            // Validate response structure
            if (!isset($responseData['other_flights'])) {
                return response()->json([
                    'error' => 'Invalid response format from API',
                    'response' => $responseData,
                ], 500);
            }

            // Extract data
            $bookingToken = $responseData['booking_token'] ?? null;
            $searchMetadata = $responseData['search_metadata'] ?? [];
            $searchParameters = $responseData['search_parameters'] ?? [];
            $otherFlights = $responseData['other_flights'] ?? [];
            $best_flights = $responseData['best_flights'] ?? [];

            return view('googleflight.results', [
                'searchMetadata' => $searchMetadata,
                'searchParameters' => $searchParameters,
                'flights' => $otherFlights,
                'booking_token' => $bookingToken,
                'best_flights' => $best_flights,
            ]);

        } catch (\Exception $e) {
            Log::error('Google Flights API Error', [
                'message' => $e->getMessage(),
                'params' => $params
            ]);

            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }

    public function index()
    {
        // Display the search form
        return view('googleflight.search');
    }
}
