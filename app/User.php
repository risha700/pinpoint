<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;



    protected $fillable = [
        'name', 'email', 'password',
    ];



    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $appends = ['is_admin'];


    public function isAdmin(){

        if(auth()->check()){
            return in_array(auth()->user()->email, ['Risha']);
        }
    }

    public function getIsAdminAttribute()
    {
        return  $this->isAdmin();

    }

    public function orders(){

        return $this->hasMany('App\Order');
    }




}
