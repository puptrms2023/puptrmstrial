<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function username()
    {
        return 'username';
    }
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
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function authenticated()
    {
        if (Auth::user()->role_as == '2') {
            return redirect('admin/dashboard')->with('status', 'Logged in Successfully');
        } else if (Auth::user()->role_as == '0') {
            return redirect('user/dashboard')->with('status', 'You are now logged in');
        } else {
            return redirect('/home')->with('status', 'You are now logged in');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
    }
}
