<?php

namespace App\Http\Controllers;
use App\Models\Location;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Http\Request;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\TransportExceptionInterface;

class FlightSearchController extends Controller
{
    public function search(Request $request)
    {
        $from = $request->query('from');
        $to = $request->query('to');
    
        if (empty($from) || empty($to)) {
            return response()->json(['error' => 'Both departure and destination cities are required.'], 400);
        }
    
        $url = "https://yemenia.com/flights-schedule/search?from=" . urlencode($from) . "&to=" . urlencode($to);
    
        try {
            $client = HttpClient::create();
            $response = $client->request('GET', $url);
            $content = $response->getContent();
            $crawler = new Crawler($content);
    
            $flights = $crawler->filter('.flight-details')->each(function (Crawler $node) {
                return [
                    'flight_number' => $node->filter('.flight-number')->text(),
                    'departure' => $node->filter('.departure-time')->text(),
                    'arrival' => $node->filter('.arrival-time')->text(),
                ];
            });
    
            return view('flight_results', ['flights' => $flights]);
    
        } catch (ClientException $e) {
            return response()->json(['error' => 'Client error occurred: ' . $e->getMessage()], 400);
        } catch (TransportExceptionInterface $e) {
            return response()->json(['error' => 'Transport error occurred: ' . $e->getMessage()], 503);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    
    public function showSearchForm()
    {
        return view('flights.search-form'); // تأكد من أن لديك view باسم flights/search-form.blade.php
    }
    public function showForm()
    {
        // استرجع مواقع الطيران من قاعدة البيانات أو من مصدر البيانات
        $locations = Location::all(); // افترض أن لديك نموذج Location
    
        // عرض النموذج
        return view('flight-search', ['locations' => $locations]);
    }
    
}
