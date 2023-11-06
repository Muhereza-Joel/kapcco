<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "vendor/autoload.php";
require_once "autoload.php";

$router = new kapcco\core\Router();

$router->init_routes();

$router->routeRequest($_SERVER['REQUEST_URI'], 'kapcco\middleware\AuthMiddleware');

?>