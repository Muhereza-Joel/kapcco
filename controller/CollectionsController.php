<?php
namespace kapcco\controller;

use kapcco\model\Model;

class CollectionsController{

    public function save_season(){
        $model = new Model();
        $model->set_current_season();

    }

    public function set_price_scale(){
        $model = new Model();
        $model->set_scale();
    }
}
?>