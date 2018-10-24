
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

    function
    presentOptions($options){
//    TODO: change cart array to a listed arrays in an object
        return str_replace(array('[','"',']'),'',$options);
    }

    function sort_array_of_array($serachableArray, $sortingValue, $collectedValue)
    {
        $arr = [];
        foreach($serachableArray as $key => $item)
        {
            $arr[$item[$sortingValue]][$key] = $item[$collectedValue];
        }

        ksort($arr, SORT_STRING);
        return $arr;
    }


    function getOpsRequest($filteredRequest){
        preg_match_all("/(options-).(\w+)/", $filteredRequest, $matches);

        $reqOptions = [];
        foreach (current($matches) as $key=>$val){
               $reqOptions[]= $val;
        }
//        foreach ($matches[0] as $key=>$val){
//               $reqOptions[]= $val;
//        }
        return $reqOptions;


    }

    function set_option_name($input){

        return preg_replace("/(options-)/", '',$input);

    }
    function cart_options_array($req){
        preg_match_all('/(options-).(\w+)/',collect($req), $key_val);
        preg_match_all('/(?=options-\w+\S.*?(\w+))/', collect($req) , $value_val);
//        dd($value_val, $key_val);

//       TODO:  some condition to make sure the length are the same
        $ops = array_combine($key_val[0], $value_val[1]);
        return $ops;

    }
function reformatWishListOptionsArray($input){
    $n = str_replace(array('{','"','}'),'',$input);
    $n = explode("," , $n);

    for($i=0;$i<sizeof($n);$i++){
        $n[$i]= explode(':',$n[$i]);
    }
    $nArr=[];
    foreach ($n as $k=>$v){
        $nArr[$k]=$v;
    }

    $zArr = [];
  foreach ($nArr as $key=>$val){
        $zArr[$nArr[$key][0]] = $nArr[$key][1];
  }

//  dd($zArr);
    return $zArr;

}


function getItemOrIndex($item){

        if(sizeof($item)==1){
            return $item[0];
        }else{
            return $item;
        }
}