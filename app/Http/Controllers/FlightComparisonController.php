<?php

namespace App\Http\Controllers;

use App\Services\FlightComparisonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FlightComparisonController extends Controller
{
    protected $flightComparisonService;

    public function __construct(FlightComparisonService $flightComparisonService)
    {
        $this->flightComparisonService = $flightComparisonService;
    }

    /**
     * Compare flights and show the results.
     *
     * @return \Illuminate\View\View
     */
    public function compareFlights()
    {
        // رابط الصفحة الرسمية
        $officialUrl = 'https://yemenia.com/flights';

        try {
            // جلب بيانات الرحلات من الصفحة الرسمية
            $officialFlights = $this->flightComparisonService->fetchFlightsFromOfficialPage($officialUrl);

            // سجل البيانات المرسلة إلى العرض
            Log::info('Data passed to view: ', $officialFlights);

            // عرض البيانات في العرض
            return view('flights.comparison', [
                'officialFlights' => $officialFlights,
            ]);
        } catch (\Exception $e) {
            // سجل الخطأ في حال حدوث مشكلة
            Log::error('Error fetching flights: ' . $e->getMessage());

            // عرض صفحة خطأ أو رسالة مناسبة
            return view('flights.error', [
                'message' => 'Unable to fetch flight data at the moment.'
            ]);
        }
    }
}
