<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Flight;
use Carbon\Carbon;

class YemeniaController extends Controller
{
    public function index()
    {

        
        // Retrieve all locations
        $locations = Location::all(['name', 'code']); 

        // Retrieve all flights for today
        $today = Carbon::now()->format('Y-m-d');
        $flightsToday = Flight::whereDate('departure_time', $today)->get(); 

        // Debugging information
        $debuggingInfo = [
            'today' => $today,
            'flightsCount' => $flightsToday->count(),
            'flights' => $flightsToday
        ];

        return view('yemenia.index', [
            'locations' => $locations,
            'flightsToday' => $flightsToday,
            'debuggingInfo' => $debuggingInfo // Pass debugging information to the view
        ]);
    }

    public function search(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $date = $request->input('date');

        // Get the current date if no date is provided
        $date = $date ?: Carbon::now()->format('Y-m-d');

        $query = Flight::query();
        
        if ($from) {
            $query->where('departure_code', $from);
        }
        
        if ($to) {
            $query->where('arrival_code', $to);
        }

        $query->whereDate('departure_time', $date);

        $flights = $query->get(); // Retrieve the collection of flights

        // Retrieve all locations to use in the view
        $locations = Location::all(['name', 'code']); 

        return view('yemenia.results', [
            'flights' => $flights,
            'locations' => $locations
        ]);
    }
}
