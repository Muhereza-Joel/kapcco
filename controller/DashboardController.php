<?php
namespace kapcco\controller;

use kapcco\core\Session;
use kapcco\view\BladeView;

class DashboardController{
    public function index(){
        $blade_view = new BladeView();
        $html = $blade_view->render('dashboard', [
            'pageTitle' => "KAPCCO-Dashboard",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
        ]);

        echo ($html);
    }
}
?>