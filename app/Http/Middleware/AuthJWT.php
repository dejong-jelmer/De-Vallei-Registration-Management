<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Request;
use Exception;

class AuthJWT
{
    /**
    * Handle eenn inkomende request.
    *
    * @param \Illuminate\Http\Request $request
    * @param \Closure $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
        try {
            
            if(!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Gebruiker niet gevonden'], 404);
            }

        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {

                return response()->json(['error' => 'Token ongeldig'], 401);

            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                
                return response()->json(['error' => 'Token verlopen'], 401);
            } else {
                
                return response()->json(['error' => 'Authenticatie fout'], 401);
            }
        }

        return $next($request);

        
    }
}