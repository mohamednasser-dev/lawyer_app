<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class resetPassMail extends Mailable
{
    use Queueable, SerializesModels;
    public $token;
    public function __construct($token)
    {
        $this->token = $token;
    }
    public function build()
    {
        return $this->markdown('Mail.Messages.resetPassMail')->with('token',$this->token);
    }
}
