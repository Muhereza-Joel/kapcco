<?php
namespace kapcco\core;

class Session{
    //TODO Follow Up About Implementing secure sessions

    public static function start(){
        if(session_status() == PHP_SESSION_NONE){
            session_name(getenv('APP_NAME'));
            session_start();
        }
    }

    public static function set($key, $value){
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null){
        self::start();
        return(isset($_SESSION[$key]) ? $_SESSION[$key] : $default);
    }

    public static function remove($key){
        self::start();
        unset($_SESSION[$key]);
    }

    public static function destroy(){
        self::start();
        session_destroy();
    }

    public static function isLoggedIn(){
        self::start();
        return isset($_SESSION['user_id']);
    }
}
?>