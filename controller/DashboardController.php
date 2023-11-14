<?php
namespace kapcco\controller;

use kapcco\core\Session;
use kapcco\model\Model;
use kapcco\view\BladeView;

class DashboardController{
    public function index(){
        $blade_view = new BladeView();
        $html = $blade_view->render('dashboard', [
            'pageTitle' => "KAPCCO - Dashboard",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
        ]);

        echo ($html);
    }

    public function render_add_collection_view(){
        $blade_view = new BladeView();
        $html = $blade_view->render('addCollection', [
            'pageTitle' => "KAPCCO - Add Collection",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
        ]);

        echo ($html);
    }


    public function render_collections_view(){
        $blade_view = new BladeView();
        $html = $blade_view->render('collections', [
            'pageTitle' => "KAPCCO - Collections",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
        ]);

        echo ($html);
    }


    public function render_branches_view($action = null, $id = null){
        $model = new Model();
        $branches = $model->get_all_branches();
        $branch_details = $model->get_branch_details($id);

        $blade_view = new BladeView();
        $html = $blade_view->render('branches', [
            'pageTitle' => "KAPCCO - branches",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'action' => $action,
            'branches' => $branches,
            'branchDetails' => $branch_details
        ]);

        echo ($html);
    }

    public function render_zones_view($action = null, $id = null){
        $model = new Model();
        $branches = $model->get_all_branches();
        $zones = $model->get_all_zones();
        $zone_details = $model->get_zone_details($id);

        $blade_view = new BladeView();
        $html = $blade_view->render('zones', [
            'pageTitle' => "KAPCCO - Zones",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'action' => $action,
            'branches' => $branches,
            'zones' => $zones,
            'zoneDetails' => $zone_details
        ]);

        echo ($html);

    }

    public function render_farmers_view(){
        $blade_view = new BladeView();
        $html = $blade_view->render('farmers', [
            'pageTitle' => "KAPCCO - farmers",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
        ]);

        echo ($html);
    }
}
?>