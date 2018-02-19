<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['login' => false, 'error' => [

                'message' => 'Inloggen mislukt']], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['login' => false, 'error' => [

                'message' => 'Token aanmaken mislukt']], 500);
        }

        // all good so return the token
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

