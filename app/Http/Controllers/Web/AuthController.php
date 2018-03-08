<?php

namespace App\Http\Controllers\Web;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    
    public function getLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {


            // $user = Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'] ]);
            $user = Auth::attempt($credentials);

        } catch(Exception $exception) {
            dd($exception);
        }

        if(!$user) {
            return redirect()->back()->with('error', 'Je bent niet ingelogd');    
        } 

        return redirect('home')->with('success', 'Je bent ingelogd');

    }

    public function logout() 
    {
        Auth::logout();
        return redirect('/')->with('info', 'Je bent uitgelogd');
    }
}
