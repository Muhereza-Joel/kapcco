<?php
namespace kapcco\core;

class Request{

    public static function capture(){
        return new self();
    }

    public function input($key, $default = null){
        return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
    }

    public static function send_response($http_status, $response){
        header('Content-Type: application/json');
        http_response_code($http_status);
        echo json_encode($response);
      
      }
}
?>