<?php

namespace App\Http;


class Flash{


    public function create($title , $message, $level , $btnText = null , $key = 'flash_message' )
    {


        session()->flash($key, [
            "title"=> $title,
            "message" => $message,
            "level" => $level,
            "btnText" => $btnText
        ]);
    }


    public function success($title , $message ){
        return $this->create($title, $message, 'success');

    }

    public function info($title, $message )
    {


        return $this->create($title, $message, 'info');
    }



    public function error($title, $message ){

        return $this->create($title, $message, 'error');
    }


    public function warning($title, $message ){

        return $this->create($title, $message, 'warning');
    }


    public function overlay($title, $message, $level = 'success', $btnText='Ok'){

        return $this->create($title, $message, $level, $btnText, 'flash_message_overlay');
    }



}