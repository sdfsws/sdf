<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Location;

class FlightScheduleController extends Controller
{
    public function index()
    {
        $locations = Location::all(['name', 'code']);
        $today = date('Y-m-d');

        // Define airports of interest (e.g., Sana'a, Aden)
        $mainAirports = ['6456'];

        $flights = [];
        foreach ($mainAirports as $airportCode) {
            foreach ($locations as $location) {
                if ($airportCode !== $location->code) {
                    $url = "https://yemenia.com/flights-schedule?from={$airportCode}&to={$location->code}&date={$today}";
                    $flights = array_merge($flights, $this->fetchFlightsFromUrl($url));
                }
            }
        }

        return view('yemenia.all_flights', ['flights' => $flights]);
    }

    private function fetchFlightsFromUrl($url)
{
    $client = HttpClient::create();

    try {
        $response = $client->request('GET', $url);
        $content = $response->getContent();
    } catch (\Symfony\Component\HttpClient\Exception\TransportExceptionInterface $e) {
        \Log::error('HTTP request failed: ' . $e->getMessage());
        return [];
    }

    \Log::info('Fetched content from URL: ' . $url);
    \Log::info('Content: ' . substr($content, 0, 2000)); // Log the first 2000 characters

    $crawler = new Crawler($content);

    return $crawler->filter('table.table-striped tbody tr')->each(function (Crawler $node) {
        return [
            'flight_number' => $node->filter('td')->eq(0)->text(),
            'from' => $node->filter('td')->eq(1)->text(),
            'to' => $node->filter('td')->eq(2)->text(),
            'departure' => $node->filter('td')->eq(3)->text(),
            'arrival' => $node->filter('td')->eq(4)->text(),
        ];
    });
}


    
    public function scrapeFlightSchedules(Request $request)
    {
        
        // Get the parameters from the request
        $fromCode = $request->query('from');
        $toCode = $request->query('to');
        $date = $request->query('date');

        if (!$fromCode || !$toCode || !$date) {
            return redirect()->route('yemenia.index')->with('error', 'Missing parameters');
        }

        // Retrieve location names from the database
        $fromLocation = Location::where('code', $fromCode)->value('name');
        $toLocation = Location::where('code', $toCode)->value('name');

        if (!$fromLocation || !$toLocation) {
            return redirect()->route('yemenia.index')->with('error', 'Invalid location code');
        }

        // Construct the URL with location codes
        $url = "https://yemenia.com/flights-schedule?from={$fromCode}&to={$toCode}&date={$date}";

        $client = HttpClient::create();

        try {
            $response = $client->request('GET', $url);
            $content = $response->getContent();
        } catch (\Symfony\Component\HttpClient\Exception\TransportExceptionInterface $e) {
            \Log::error('HTTP request failed: ' . $e->getMessage());
            return redirect()->route('yemenia.index')->with('error', 'Failed to fetch flight schedules');
        }

        $crawler = new Crawler($content);
        
        // Adjust the selectors based on the actual HTML structure
        $flights = $crawler->filter('table.table-striped tbody tr')->each(function (Crawler $node) use ($fromLocation, $toLocation) {
            $fromToText = $node->filter('td')->eq(1)->text();

            // Determine 'From' and 'To' locations
            $from = $fromLocation;
            $to = $toLocation;

            // You can add more advanced parsing logic here if necessary
            // For example, splitting and matching text to locations

            return [
                'flight_number' => $node->filter('td')->eq(0)->text(),
                'from' => $from,
                'to' => $to,
                'departure' => $node->filter('td')->eq(2)->text(),
                'arrival' => $node->filter('td')->eq(3)->text(),
            ];
        });

        return view('yemenia.results', ['flights' => $flights]);
    }

}
