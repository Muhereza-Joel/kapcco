<?php
namespace kapcco\controller;

use kapcco\view\BladeView;

class AuthController{
    public function index(){
        $blade_view = new BladeView();
        $html = $blade_view->render('login', [
            'pageTitle' => "KAPCCO Auth-Login",
            'appName' => getenv('APP_NAME'),
        ]);

        echo ($html);
    
    }

}


?>