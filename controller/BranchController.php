<?php

namespace kapcco\controller;

use kapcco\model\Model;

class BranchController
{

    public function add_branch()
    {
        $model = new Model();
        $model->add_branch();
    }

    public function edit_branch()
    {
        $model = new Model();
        $model->update_branch();
    }

    public function delete_branch()
    {
        $model = new Model();
        $model->delete_branch();
    }
}
