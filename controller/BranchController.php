<?php
namespace kapcco\controller;

use kapcco\model\Model;

class BranchController{

    public function add_branch(){
        $model = new Model();
        $model->add_branch();
    }
}

?>