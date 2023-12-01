<?php

namespace kapcco\controller;

use kapcco\core\Request;
use kapcco\core\Session;
use kapcco\model\Model;
use kapcco\view\BladeView;

class DashboardController
{
    public function index()
    {
        $model = new Model();
        $last_collections = $model->get_last_collections();
        $branches_total = $model->get_branches_total();
        $stores_total = $model->get_stores_total();
        $farmers_total = $model->get_farmers_total();

        $blade_view = new BladeView();
        $html = $blade_view->render('dashboard', [
            'pageTitle' => "KAPCCO - Dashboard",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'lastCollections' => $last_collections,
            'branchesTotal' => $branches_total,
            'storesTotal' => $stores_total,
            'farmersTotal' => $farmers_total
        ]);

        echo ($html);
    }

    public function render_add_collection_view()
    {
        $model = new Model();
        $current_season = $model->get_current_season();
        $branches = $model->get_all_branches();
        $scales = $model->get_scales_for_current_season($current_season['id']);

        $blade_view = new BladeView();
        $html = $blade_view->render('addCollection', [
            'pageTitle' => "KAPCCO - Add Collection",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'currentSeason' => $current_season,
            'branches' => $branches,
            'scales' => $scales
        ]);

        echo ($html);
    }


    public function render_collections_view()
    {
        $model = new Model();
        $current_season = $model->get_current_season();
        $scales = $model->get_scales_for_current_season($current_season['id']);

        $blade_view = new BladeView();
        $html = $blade_view->render('collections', [
            'pageTitle' => "KAPCCO - Collections",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'currentSeason' => $current_season,
            'scales' => $scales
        ]);

        echo ($html);
    }


    public function render_branches_view($action = null, $id = null)
    {
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

    public function render_zones_view($action = null, $id = null)
    {
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

    public function render_branch_stores_reports_view()
    {
        $model = new Model();
        $current_season = $model->get_current_season();
        $branches = $model->get_all_branches();
        $last_collections = $model->get_last_collections();

        $blade_view = new BladeView();
        $html = $blade_view->render('branchStoreReports', [
            'pageTitle' => "KAPCCO - Zones",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'currentSeason' => $current_season,
            'branches' => $branches,
            'lastCollections' => $last_collections,

        ]);

        echo ($html);
    }

    public function get_all_farmers_view($action = null, $id = null)
    {
        $model = new Model();
        $farmers = $model->get_all_farmers();
        $user_details = $model->get_user_details($id);


        $blade_view = new BladeView();
        $html = $blade_view->render('farmers', [
            'pageTitle' => "KAPCCO - farmers",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'action' => $action,
            'farmers' => $farmers,
            'userDetails' => $user_details,
        ]);

        echo ($html);
    }

    public function render_farmers_view($action = null, $id = null)
    {
        $model = new Model();
        $farmers = $model->get_all_farmers();
        $user_details = $model->get_user_details($id);
        $stores_to_assign = $model->get_stores_to_assign($user_details['user_id']);
        $assigned_stores = $model->get_farmer_assignments($user_details['user_id']);

        $blade_view = new BladeView();
        $html = $blade_view->render('farmers', [
            'pageTitle' => "KAPCCO - farmers",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'action' => $action,
            'farmers' => $farmers,
            'userDetails' => $user_details,
            'storesToAssign' => $stores_to_assign,
            'assignedStores' => $assigned_stores
        ]);

        echo ($html);
    }

    public function render_my_collections_view()
    {
        $model = new Model();
        $assigned_stores = $model->get_farmer_assignments(Session::get('user_id'));
        $last_collections = $model->get_last_collections();

        $blade_view = new BladeView();
        $html = $blade_view->render('myCollections', [
            'pageTitle' => "KAPCCO - farmers",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'userId' => Session::get('user_id'),
            'assignedStores' => $assigned_stores,
            'lastCollections' => $last_collections,

        ]);

        echo ($html);
    }

    public function render_my_collections_info_view()
    {
        $model = new Model();
        $current_season = $model->get_current_season();
        $scales = $model->get_scales_for_current_season($current_season['id']);
        $assigned_stores = $model->get_farmer_assignments(Session::get('user_id'));

        $blade_view = new BladeView();
        $html = $blade_view->render('myCollectionsInfo', [
            'pageTitle' => "KAPCCO - farmers",
            'appName' => getenv('APP_NAME'),
            'username' => Session::get('username'),
            'role' => Session::get('role'),
            'avator' => Session::get('avator'),
            'currentSeason' => $current_season,
            'scales' => $scales,
            'assignedStores' => $assigned_stores
        ]);

        echo ($html);
    }

    public function approve_all($ids)
    {
        $model = new Model();
        $model->approve_all($ids);
    }

    public function assign_all($ids)
    {
        $model = new Model();
        $request = Request::capture();
        $farmer_id = $request->input('farmer_id');

        $model->assign_stores_to_farmer($farmer_id, $ids);
    }

    public function drop_all_assignments($ids)
    {
        $model = new Model();
        $request = Request::capture();
        $farmer_id = $request->input('farmer_id');

        $model->drop_farmer_assignments($farmer_id, $ids);
    }
}
