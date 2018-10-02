
<?php


function set_active($path, $active = 'uk-active') {

    return call_user_func_array('Request::is', (array)$path) ? $active : '';

}

function flash($title = null, $message= null){

    $flash = app('\App\Http\Flash');

    if(func_num_args() == 0 ){

        return $flash;
    }
    return $flash->info($message, $title);

}


function presentPrice($price){

    return money_format('$%i', $price / 100);

}