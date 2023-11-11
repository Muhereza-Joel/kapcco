<?php
namespace kapcco\controller;

use Illuminate\Support\Facades\URL;
use kapcco\model\User;
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

    public function render_register_view(){
        $blade_view = new BladeView();
        $html = $blade_view->render('register', [
            'pageTitle' => "KAPCCO Auth-Register",
            'appName' => getenv('APP_NAME'),
        ]);

        echo ($html);
    }

    public function render_create_profile_view(){
        $blade_view = new BladeView();
        $html = $blade_view->render('createProfile', [
            'pageTitle' => "KAPCCO Auth-Register",
            'appName' => getenv('APP_NAME'),
        ]);

        echo ($html);
    }

    public function sign_in_user(){
        User::login();
    }

    public function create_account(){
        $user = new User();
        $user->add_user();
    }

}


?>