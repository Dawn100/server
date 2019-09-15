<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    }

    public function apiLogin(Request $request)
    {	
        
        error_log("email ".$request['email']);

        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];


        if (Auth::attempt($credentials)) {
            error_log("SUCCESS");
            return response()->json([
                'message'=>"Login Success",
                'api_token'=>Auth::user()->api_token
            ],200);
        }
        else{
            error_log("FAIL");
            return response()->json([
                'message'=>'Email or Password is incorrect'
            ], 200); // Status code here
        }
    }
}
