<?php
namespace kapcco\controller;

use Illuminate\Support\Facades\URL;
use kapcco\core\Session;
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

    public function render_show_profile_view(){
        $model = new User();
        $userDetails = $model->get_all_user_data(Session::get('user_id'));
        
        $blade_view = new BladeView();
        $html = $blade_view->render('viewProfile', [
            'pageTitle' => "KAPCCO - Dashboard",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'userDetails' => $userDetails
        ]);

        echo ($html);
    }

    public function sign_in_user(){
        $user = new User();
        $user->login();
    }

    public function sign_out(){
        Session::destroy();
        header("location:/kapcco/auth/login/");
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
    public function check_email(){
        $user = new User();
        $user->check_email();

    }

    public function save_profile(){
        $user = new User();
        $user->save_profile();

    }

    public function update_profile(){
        $user = new User();
        $user->update_profile();

    }

    public function update_photo(){
        $user = new User();
        $user->update_photo();

    }

    public function check_password($password){
        $user = new User();
        $user->check_password($password);

    }

    public function change_password(){
        $user = new User();
        $user->change_password();

    }

}


?>