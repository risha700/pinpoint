<?php

namespace App;

use App\Http\Traits\Billable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
use Notifiable , Billable;

    protected $guarded=[];



    public function user(){
        return $this->belongsTo('App\User');
    }

    public function products(){
        return $this->belongsToMany('App\Product')->withPivot('quantity');
    }


    public function routeNotificationForNexmo($notification)
    {
        return $this->phone;
    }


}
