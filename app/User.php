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
        'password', 'remember_token','email'
    ];


    protected $appends = ['is_admin'];

    protected $with=['orders'];

    public function isAdmin(){

        if(auth()->check()){
            return in_array(auth()->user()->email, ['ahbox@outlook.com']);
        }
    }

    public function getRouteKeyName()
    {

        return str_slug('name', "-");
    }

    public function getIsAdminAttribute()
    {
        return  $this->isAdmin();

    }

    public function orders(){

        return $this->hasMany('App\Order');
    }



//    public function getOrdersAttribute(){
//        return $this->attributes['orders'] = sort_array_of_array($this->orders()->get(), 'user_id', 'id');
//    }
//    public function setOrdersAttribute(){
//        return $this->attributes['orders'] = $this->orders;
//    }


}
