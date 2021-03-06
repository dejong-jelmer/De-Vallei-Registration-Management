<?php

namespace App\Http\Controllers\Api;

use Auth;
use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        Auth::attempt($credentials);
        if(Auth::user()->is_app) {
            if($request->ip() != '192.168.0.1') {
                die('Geen toegang');
            }
        }
        

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['login' => false, 'error' => [

                'message' => 'Inloggen mislukt']], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['login' => false, 'error' => [

                'message' => 'Token aanmaken mislukt']], 500);
        }

        return response()->json(compact('token'));
    }

    public function logout(Request $request)
    {
        
        try {

            JWTAuth::invalidate($request->input('token'));
            
            return response()->json(['logout' => true]);
        
        } catch (JWTException $e) {
            
            return response()->json(['logout' => false, 'error' => [

                'message' => 'Uitloggen mislukt']], 500);
        }
    }
}

