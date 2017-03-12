<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
Use App\User;

class NewUserSignUp extends Mailable
{
    use Queueable, SerializesModels;

    public $_user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->_user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from('hello@app.com', 'Faddit')
            ->subject('Welcome : ' . $this->_user->nickname)
            ->view('mail.newusersignup');
    }
}
