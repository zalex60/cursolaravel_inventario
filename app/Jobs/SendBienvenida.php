<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

use App\Mail\Bienvenida;
use App\User;

class SendBienvenida implements ShouldQueue{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $email;
    protected $user;
    protected $token;
    protected $emisor_id;
    protected $receptor_id;

    public function __construct($email, $user, $emisor_id, $receptor_id){
        $user=User::find($receptor_id);
        $this->email=$email;
        $this->user = $user->name;
        $this->token=$user->password;
        $this->emisor_id = $emisor_id;
        $this->receptor_id = $receptor_id;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
        Mail::to($this->email)->send(new Bienvenida($this->user, $this->token, $this->email));
    }
}