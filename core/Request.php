<?php
namespace kapcco\core;

class Request{

    public static function capture(){
        return new self();
    }

    public function input($key, $default = null){
        return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
    }
}
?>