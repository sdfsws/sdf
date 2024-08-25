<?php

namespace App\Services;

use GuzzleHttp\Client;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Log;

class FlightComparisonService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchFlightsFromOfficialPage(string $url): array
    {
        try {
            // جلب المحتوى من الصفحة الرسمية
            $response = $this->client->request('GET', $url);
            $html = $response->getBody()->getContents();

            // تحميل المحتوى إلى DOMDocument
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($html);
            libxml_clear_errors();

            // استخدم DOMXPath لاستخراج البيانات
            $xpath = new DOMXPath($dom);
            $tables = $xpath->query('//table[contains(@class, "table-bordered")]'); // تحديث الاستعلام للعثور على جميع الجداول

            $flights = [];
            foreach ($tables as $table) {
                $rows = $xpath->query('.//tbody//tr', $table);
                foreach ($rows as $row) {
                    $cells = $xpath->query('.//td', $row);
                    if ($cells->length >= 6) { // تأكد من وجود جميع الخلايا المطلوبة
                        $departureTimeElement = $xpath->query('.//p/strong', $cells->item(2))->item(0);
                        $departureTimeSmallElement = $xpath->query('.//p/small', $cells->item(2))->item(0);
                        $arrivalTimeElement = $xpath->query('.//p/strong', $cells->item(3))->item(0);
                        $arrivalTimeSmallElement = $xpath->query('.//p/small', $cells->item(3))->item(0);

                        $flight = [
                            'flight_number' => trim($cells->item(0)->nodeValue),
                            'status' => trim($cells->item(1)->nodeValue),
                            'departure_time' => $departureTimeElement ? trim($departureTimeElement->nodeValue) . ' ' . ($departureTimeSmallElement ? trim($departureTimeSmallElement->nodeValue) : '') : '',
                            'arrival_time' => $arrivalTimeElement ? trim($arrivalTimeElement->nodeValue) . ' ' . ($arrivalTimeSmallElement ? trim($arrivalTimeSmallElement->nodeValue) : '') : '',
                            'departure_city' => trim($cells->item(4)->nodeValue) ?? 'N/A',
                            'arrival_city' => trim($cells->item(5)->nodeValue) ?? 'N/A',
                        ];

                        $flights[] = $flight;
                    }
                }
            }

            // إزالة التكرارات
            return array_values(array_unique($flights, SORT_REGULAR));
        } catch (\Exception $e) {
            // التعامل مع الأخطاء
            Log::error('Error fetching or processing flights: ' . $e->getMessage());
            return [];
        }
    }
}
