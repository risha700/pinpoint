<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];

    protected $with = [ 'photos', 'options','categories'];


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


    public function options(){

        return $this->belongsToMany('\App\Option','product_option');
    }


    public function order(){

        return $this->belongsToMany('\App\Order','order_product');
    }


    public function getOptionsAttribute(){
        return $this->attributes['options'] = sort_array_of_array($this->options()->get(), 'name', 'type');
    }
    public function setOptionsAttribute(){
        return $this->attributes['options'] = $this->options;
    }

}
