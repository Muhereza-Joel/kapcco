<?php

namespace kapcco\controller;

use kapcco\core\Request;
use kapcco\model\Model;

class CollectionsController
{

    public function save_season()
    {
        $model = new Model();
        $model->set_current_season();
    }

    public function set_price_scale()
    {
        $model = new Model();
        $model->set_scale();
    }

    public function get_product_unit_price($product_type)
    {
        $model = new Model();
        $unit_price = $model->get_product_scale($product_type);

        $response = ['price' => $unit_price];
        $httpStatus = 200;

        Request::send_response($httpStatus, $response);
    }

    public function add_collection()
    {
        $model = new Model();
        $model->save_collection_data();
    }
}
