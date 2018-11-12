<?php

namespace App;

use App\Http\Traits\Billable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
use Notifiable , Billable;

    protected $guarded=[];

    protected $with=['products'];



    public function user(){
        return $this->belongsTo('App\User');
    }

    public function products(){
        return $this->belongsToMany('App\Product','order_product')->withPivot('quantity');
    }


    public function routeNotificationForNexmo($notification)
    {
        return $this->phone;
    }
//    public function getProductsAttribute(){
////        return $this->attributes['products'] = array_pull($this->products()->toArray(), 'options');
//
//
//    }
//    public function setProductsAttribute(){
//
//        dd($this->products);
//        return $this->products();
//
//    }

}
