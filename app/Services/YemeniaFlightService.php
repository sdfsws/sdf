<?php

namespace App\Services;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;

class YemeniaFlightService
{
    protected $client;

    public function __construct()
    {
        $this->client = HttpClient::create();
    }

    public function searchFlights(string $departure, string $destination): array
    {
        $departure = urlencode($departure);
        $destination = urlencode($destination);

        $url = "https://yemenia.com/flights-schedule?from={$departure}&to={$destination}";

        try {
            $response = $this->client->request('GET', $url);
            
            // Check the HTTP status code
            $statusCode = $response->getStatusCode();
            if ($statusCode !== 200) {
                throw new \Exception('Unexpected status code: ' . $statusCode);
            }

            $content = $response->getContent();
            $crawler = new Crawler($content);

            // Extract flight details using updated selectors
            $flights = $crawler->filter('table.table-striped tbody tr')->each(function (Crawler $node) {
                return [
                    'flight_number' => $node->filter('td:nth-of-type(1) strong')->text(),
                    'departure' => $node->filter('td:nth-of-type(2) p')->text(),
                    'departure_time' => $node->filter('td:nth-of-type(3) p')->text(),
                    'arrival_time' => $node->filter('td:nth-of-type(4) p')->text(),
                ];
            });

            return $flights;
        } catch (\Exception $e) {
            // Log the error and return a user-friendly message
            \Log::error('Flight search error: ' . $e->getMessage());
            return ['error' => 'Unable to fetch flight data. Please try again later.'];
        }
    }
}
