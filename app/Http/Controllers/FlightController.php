<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Flight::class, 'flight');
    }

    public function index()
    {
        $this->authorize('viewAny', Flight::class);
        $flights = Flight::all();
        return view('flights.index', compact('flights'));
    }

    public function create()
    {
        $this->authorize('create', Flight::class);
        return view('flights.create');
    }

    public function store(Request $request)
    {
        // Authorization check
        $this->authorize('create', Flight::class);

        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'departure' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required|date_format:Y-m-d\TH:i',
        ]);

        // Create a new flight record
        Flight::create(array_merge($validatedData, ['user_id' => $request->user()->id]));

        // Redirect to the flights index with a success message
        return redirect()->route('flights.index')->with('status', 'Flight booked successfully!');
    }

    public function show(Flight $flight)
    {
        $this->authorize('view', $flight);
        return view('flights.show', compact('flight'));
    }

    public function edit(Flight $flight)
    {
        $this->authorize('update', $flight);
        return view('flights.edit', compact('flight'));
    }

    public function update(Request $request, Flight $flight)
    {
        $this->authorize('update', $flight);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'departure' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required|date_format:Y-m-d\TH:i',
        ]);

        $flight->update($validatedData);

        // Redirect with success message
        return redirect()->route('flights.index')->with('status', 'Flight updated successfully!');
    }

    public function destroy(Flight $flight)
    {
        $this->authorize('delete', $flight);
        $flight->delete();
        return redirect()->route('flights.index')->with('status', 'Flight deleted successfully!');
    }

    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'departure' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $flights = Flight::where('departure', $validatedData['departure'])
                        ->where('destination', $validatedData['destination'])
                        ->whereDate('departure_time', $validatedData['date'])
                        ->get();

        return view('flights.search', compact('flights'));
    }
}
