<?php
namespace kapcco\controller;

use kapcco\core\Request;
use kapcco\model\Model;

class ZonesController{
    public function add_zone(){
        $model = new Model();
        $model->add_zone();
    }

    public function edit_zone(){
        $model = new Model();
        $model->edit_zone();
    }

    public function delete_zone(){
        $model = new Model();
        $model->delete_zone();
    }

    public function get_zones_by_id($branch_id){
        $model = new Model();
        $stores = $model->get_stores_by_parent_branch_id($branch_id);
        $collections = $model->get_collections($branch_id);

        $response = ['stores' => $stores, 'collections' => $collections];
        $httpStatus = 200;
  
        Request::send_response($httpStatus, $response);

    }

    public function get_farmers_by_store_id($store_id){
        $model = new Model();
        $farmers = $model->get_farmers_by_store_id($store_id);
        $collections = $model->get_collections(NULL, $store_id);

        $response = ['farmers' => $farmers, 'collections' => $collections];
        $httpStatus = 200;
  
        Request::send_response($httpStatus, $response);
    }
}
?>