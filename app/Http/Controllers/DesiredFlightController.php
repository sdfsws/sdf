<?php

// app/Http/Controllers/DesiredFlightController.php
namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\DesiredFlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesiredFlightController extends Controller
{
    public function store(Request $request)
    {
        // التحقق من أن flight_id متوفر في الطلب
        if (!$request->has('flight_id') || empty($request->input('flight_id'))) {
            return redirect()->back()->with('error', 'لم يتم تحديد الرحلة. يرجى المحاولة مرة أخرى.');
        }

        // تحقق من صحة flight_id
        $validatedData = $request->validate([
            'flight_id' => 'required|exists:flights,id',
        ]);

        $user_id = Auth::id();
        $flight = Flight::findOrFail($validatedData['flight_id']);

        // تحقق مما إذا كان المستخدم قد أضاف الرحلة بالفعل
        if (DesiredFlight::where('user_id', $user_id)->where('flight_id', $flight->id)->exists()) {
            return redirect()->back()->with('status', 'تمت إضافة الرحلة بالفعل إلى قائمة الرحلات المطلوبة.');
        }

        // إنشاء الرحلة المطلوبة
        DesiredFlight::create([
            'user_id' => $user_id,
            'flight_id' => $flight->id,
        ]);

        return redirect()->back()->with('success', 'تمت إضافة الرحلة إلى قائمة الرحلات المطلوبة بنجاح.');
    }
}
