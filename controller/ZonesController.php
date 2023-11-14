<?php
namespace kapcco\controller;

use kapcco\model\Model;

class ZonesController{
    public function add_zone(){
        $model = new Model();
        $model->add_zone();
    }
}
?>