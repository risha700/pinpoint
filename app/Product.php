<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];

//    protected $with = [ 'photos'];

    public function photos(){

        return $this->hasMany('App\Photo');
    }

    public function mayLike(){

//        temporary
        return $this->where('stock','>=','10');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function categories(){

        return $this->belongsToMany('\App\Category', 'product_category');
    }


}
