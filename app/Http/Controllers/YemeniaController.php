<?php
namespace App\Http\Controllers;

use Symfony\Component\HttpClient\HttpClient;
use Illuminate\Support\Facades\Log;
use App\Services\FlightService;

class YemeniaController extends Controller
{
    protected $flightService;

    public function __construct(FlightService $flightService)
    {
        $this->flightService = $flightService;
    }

    public function allFlights()
    {
        $url = "https://yemenia.com/flights";
        $flights = $this->fetchFlights($url);
        return view('yemenia.all_flights', ['flights' => $flights]);
    }

    protected function fetchFlights(string $url): array
    {
        try {
            $client = HttpClient::create();
            $response = $client->request('GET', $url);
            $content = $response->getContent();
            // تسجيل محتوى الاستجابة للتحقق من صحته
            Log::info('Fetched content: ' . $content);
        } catch (\Exception $e) {
            Log::error('Error fetching flights: ' . $e->getMessage());
            return ['error' => 'Error fetching flights: ' . $e->getMessage()];
        }

        // تأكد من وجود هذه الدالة في FlightService وأنها تعمل بشكل صحيح
        return $this->flightService->allFlightsToday($content);
    }
}
