<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountDetails extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $wachtwoord)
    {
        $this->user = $user;
        $this->wachtwoord = $wachtwoord;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.account')->with([
                        'wachtwoord' => $this->wachtwoord,
                        'naam' => $this->user->naam,
                        'email' => $this->user->email,
                    ]);
    }
}
