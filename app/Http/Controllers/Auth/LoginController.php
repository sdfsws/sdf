<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DesiredFlight;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    ////////////////////////////////




    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    public function showLoginForm(Request $request)
    {
        // إذا كان هناك معرف رحلة في الاستعلام
        if ($request->has('flight_id')) {
            session(['desired_flight_id' => $request->input('flight_id')]);
        }
    
        return view('auth.login');
    }
    
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // إذا كان تسجيل الدخول ناجحًا
        if (session()->has('desired_flight_id')) {
            $flightId = session('desired_flight_id');
            session()->forget('desired_flight_id');

            DesiredFlight::create([
                'user_id' => auth()->id(),
                'flight_id' => $flightId
            ]);
        }

        return redirect()->intended($this->redirectTo);
    } else {
        // إذا كان تسجيل الدخول غير ناجح
        return redirect()->back()->withErrors([
            'email' => 'بيانات الاعتماد هذه لا تطابق سجلاتنا.',
        ]);
    }
}

    

}


