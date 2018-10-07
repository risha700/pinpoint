<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded=[];



    public function products(){

        return $this->belongsToMany('\App\Product', 'product_id');
    }

}
