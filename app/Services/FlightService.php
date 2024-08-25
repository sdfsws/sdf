<?php
namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;
use App\Models\Location;

class FlightService
{
    protected $locations;

    public function __construct()
    {
        $this->locations = Location::pluck('name')->toArray();
    }

    public function allFlights(string $htmlContent): array
    {
        $crawler = new Crawler($htmlContent);
        $flights = [];

        $crawler->filter('h3.text-primary')->each(function (Crawler $header) use (&$flights) {
            $headerText = trim($header->text());

            $from = $this->findLocation($headerText, true);
            $to = $this->findLocation($headerText, false);

            $header->nextAll()->filter('table')->each(function (Crawler $table) use ($from, $to, &$flights) {
                $table->filter('tbody tr')->each(function (Crawler $row) use ($from, $to, &$flights) {
                    $cells = $row->filter('td')->each(function (Crawler $cell) {
                        return trim($cell->text()) ?: 'N/A';
                    });

                    $departureTime = $this->parseDateTime($cells[2] ?? 'N/A');
                    $arrivalTime = $this->parseDateTime($cells[3] ?? 'N/A');

                    $flightData = [
                        'flight_number'   => $cells[0] ?? 'N/A',
                        'status'          => $cells[1] ?? 'N/A',
                        'departure_time' => $departureTime,
                        'arrival_time'   => $arrivalTime,
                        'departure_city' => $from,
                        'arrival_city'   => $to,
                    ];

                    // إضافة فحص للتكرار
                    if (!in_array($flightData, $flights)) {
                        $flights[] = $flightData;
                    }
                });
            });
        });

        return $flights;
    }

    private function findLocation(string $headerText, bool $isFrom): string
    {
        foreach ($this->locations as $location) {
            if (strpos($headerText, $location) !== false) {
                return $location;
            }
        }
        return '';
    }

    public function allFlightsToday(string $htmlContent): array
    {
        $today = date('d/m/Y');
        $allFlights = $this->allFlights($htmlContent);

        return array_filter($allFlights, function ($flight) use ($today) {
            return isset($flight['departure_time']['date']) && $flight['departure_time']['date'] === $today;
        });
    }

    public function parseDateTime($dateTimeString)
    {
        \Log::info("Parsing dateTimeString: $dateTimeString");

        if (preg_match('/(\d{2}):(\d{2})(\d{2}\/\d{2}\/\d{4})/', $dateTimeString, $matches)) {
            $formattedTime = "{$matches[1]}:{$matches[2]}";
            $formattedDate = $matches[3];

            return [
                'time' => $formattedTime,
                'date' => $formattedDate,
            ];
        }

        \Log::warning("Unexpected format for dateTimeString: $dateTimeString");

        return [
            'time' => 'N/A',
            'date' => 'N/A',
        ];
    }
}
