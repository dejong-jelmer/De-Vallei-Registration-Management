<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Mail\AccountDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function show()
    {
        return view('account.index');
    }

    public function create(Request $request)
    {
        $wachtwoord = $this->randomPassword();
        $password = Hash::make($wachtwoord);

        $credentials = ['email' => $request->input('email'), 'password' => $password, 'naam' => $request->input('naam')];

        $user = User::create($credentials);

        return back()->with(['success' => 'gebruiker aangemaakt', 'wachtwoord' => $wachtwoord, 'user' => $user ]);
    }

    public function sendAccountDetails($id, Request $request)
    {
        $user = User::findOrFail($id);

        $wachtwoord = $request->wachtwoord;

        Mail::to($user->email)->send(new AccountDetails($user, $wachtwoord));

        return back()->with('success', 'mail verstuurd');
    }

    private function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = [];
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
    return implode($pass);
}


}
