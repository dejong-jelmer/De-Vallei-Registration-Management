<?php

namespace App\Http\Controllers\Web;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Je bent niet ingelogd');

    }

    public function logout() 
    {
        Auth::logout();
        return redirect()->route('login')->with('info', 'Je bent uitgelogd');
    }
}
