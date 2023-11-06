<?php
namespace kapcco\middleware;

use kapcco\core\Session;

class AuthMiddleware{
    public function handle(){
        $allowedRoutes = ['/kapcco/register/', 'kapcco/login', 'kapcco/createaccount/'];

        $currentRoute = $_SERVER['REQUEST_URI'];
        if (in_array($currentRoute, $allowedRoutes)) {
            return true; 

        } else{
            return Session::isLoggedIn();
        }

    }
}
?>