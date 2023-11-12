<?php
namespace kapcco\controller;

use Illuminate\Support\Facades\URL;
use kapcco\core\Uploader;
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
        $user = new User();
        $user->login();
    }

    public function create_account(){
        $user = new User();
        $user->add_user();
    }

    public function upload_photo(){
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])){
            $uploader = new Uploader('image');
            $uploader->save_in("../kapcco/uploads/images/");

            if ($uploader->save()) {
                // Return the URL of the uploaded image
                echo $uploader->get_file_name();
            } else {
                http_response_code(500);
                echo 'Error uploading image.';
            }
        }
    }

    public function check_nin(){
        $user = new User();
        $user->check_nin();

    }

    public function save_profile(){
        $user = new User();
        $user->save_profile();

    }

}


?>