<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Bienvenida extends Mailable{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($titular, $token, $email){
       $this->titular = $titular;
       $this->token = $token;
       $this->email = $email;
   }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->markdown('mail.bienvenido')
        ->with('titular', $this->titular)
        ->with('token', $this->token);
        //->with('email', $this->email)
        //->with('user', $this->user);
    }
}