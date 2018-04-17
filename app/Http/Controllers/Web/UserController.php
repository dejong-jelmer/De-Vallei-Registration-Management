<?php 

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Providers\AuthServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class UsersController
 * @package App\Http\Controllers
 */

class UserController
{

    public function getUsers()
    {
        $users = User::get();

        return response()->json(['gebruikers' => $users], 200);
    }
 
    /**
     * POST /users
     * @param  Request $request [description]
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        
        try {
            $user = User::create([
                'naam' => $request->input('naam'), 
                'email' => $request->input('email'), 
                'password' => Hash::make($request->input('password')), 
                'api_token' => str_random(60)
            ]);

            return response()->json(['created' => true, 'gebruiker' => $user], 201);

        } catch (\Exception $e) {
            return response()->json(['created' => false,
                'error' => [
                    'message' => 'Fout bij het aanmaken van een nieuwe gebruiker',
                    'exeption' => $e->errorInfo
                ],
            ], 400);
        }

        
    }




}