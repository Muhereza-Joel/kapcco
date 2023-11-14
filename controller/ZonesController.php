<?php
namespace kapcco\controller;

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
}
?>