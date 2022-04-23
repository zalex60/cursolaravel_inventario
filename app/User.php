<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email','perfil_id','area_id', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
 //Clase 3
    public function perfil(){
        return  $this->belongsTo('App\Models\Perfil','perfil_id');
    }

    public function area(){
        return $this->belongsTo('App\Models\Area','area_id');
    }
}
