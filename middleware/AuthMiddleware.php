<?php
namespace kapcco\middleware;

use kapcco\core\Session;

class AuthMiddleware{
    public function handle(){
        $allowedRoutes = ['/kapcco/auth/register/', '/kapcco/auth/login/', '/kapcco/auth/login/sign-in/', '/kapcco/auth/auth/create-account'];

        $currentRoute = $_SERVER['REQUEST_URI'];
        if (in_array($currentRoute, $allowedRoutes)) {
            return true; 

        } else{
            return Session::isLoggedIn();
        }

    }
}
?>