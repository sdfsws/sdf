<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\TransportException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Location;
use App\Services\FlightService;

class FlightScheduleController extends Controller
{
    protected $flightService;

    public function __construct(FlightService $flightService)
    {
        $this->flightService = $flightService;
    }

    public function index()
    {
        $locations = Location::all();
        return view('yemenia.index', ['locations' => $locations]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'date' => 'nullable|date_format:Y-m-d',
        ]);

        $fromCode = $request->input('from');
        $toCode = $request->input('to');
        $date = $request->input('date', date('Y-m-d'));

        if (!$fromCode || !$toCode) {
            return redirect()->route('yemenia.index')->with('error', 'يرجى تحديد مدينتين.')->withInput();
        }

        $url = "https://yemenia.com/flights-schedule?from={$fromCode}&to={$toCode}&date={$date}";
        $flights = $this->fetchFlightsFromUrl($url);

        \Log::info('Flight data: ', $flights);

        if (empty($flights)) {
            return redirect()->route('yemenia.index')->with('error', 'لم يتم العثور على رحلات.')->withInput();
        }

        return view('yemenia.results', ['flights' => $flights]);
    }
    protected function fetchFlightsFromUrl(string $url): array
    {
        $client = HttpClient::create();
    
        try {
            $response = $client->request('GET', $url);
            $content = $response->getContent();
            $crawler = new Crawler($content);
    
            // Retrieve locations from the database
            $locations = Location::pluck('name')->toArray();
    
            $flights = $crawler->filter('table.table-striped tbody tr')->each(function (Crawler $node) use ($locations) {
                $fromTo = $node->filter('td')->eq(1)->text();
                $from = '';
                $to = '';
                
                // Iterate over the locations to find the from and to values
                foreach ($locations as $location) {
                    if (stripos($fromTo, $location) !== false) {
                        if ($to === '') {
                            $to = $location;
                        } else {
                            $from = $location;
                            break;
                        }
                    }
                }
    
                // Extract departure and arrival times
                $departure = 'N/A';
                $departureElement = $node->filter('td')->eq(2)->filter('p');
                if ($departureElement->count() > 0) {
                    $departureText = trim($departureElement->text());
                    // Extract time and date separately
                    $departure = preg_replace('/\s+/', ' ', $departureText); // Clean up extra spaces
                }
    
                $arrival = 'N/A';
                $arrivalElement = $node->filter('td')->eq(3)->filter('p');
                if ($arrivalElement->count() > 0) {
                    $arrivalText = trim($arrivalElement->text());
                    // Extract time and date separately
                    $arrival = preg_replace('/\s+/', ' ', $arrivalText); // Clean up extra spaces
                }
    
                return [
                    'flight_number' => trim($node->filter('td')->eq(0)->text()),
                    'from' => trim($from),
                    'to' => trim($to),
                    'departure' => $departure,
                    'arrival' => $arrival,
                ];
            });
    
            //dd('Flight data:', $flights);
    
            return array_filter($flights);
    
        } catch (TransportException $e) {
            \Log::error('HTTP request failed: ' . $e->getMessage());
            return [];
        }
    }
    
    
    
}
