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


    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function apiLogin(Request $request)
    {	


        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        if (Auth::attempt($credentials)) {
            error_log("Login SUCCESS");
            return response()->json([
                'message'=>"Login Success",
		'login_status'=>1,
                'api_token'=>Auth::user()->api_token
            ],200);
        }
        else{
            error_log("Login FAIL");
            return response()->json([
                'message'=>'Email or Password is incorrect',
		'login_status'=>0
            ], 200);
        }
    }
}
