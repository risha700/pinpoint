<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{


    /**
     * @param $code
     * @return mixed
     */
    public static function findByCode($code){

        return self::where('code', $code)->first();
    }


    /**
     * @param $total
     * @return float|int|mixed
     */
    public function discount($total){


        if($this->type == 'fixed'){

            return $this->discount_value;


        }elseif ($this->type == 'percentage'){

            return ($this->discount_percentage * $total)/100;

        } else{

            return 0;

        }


    }






}
