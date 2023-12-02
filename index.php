<?php

use Dotenv\Dotenv;
use kapcco\core\Route;

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once "vendor/autoload.php";
require_once "autoload.php";

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

Route::init();

$router = new kapcco\core\Router();

$router->setDefaultRoute('kapcco\controller\AuthController@index');

$routes = Route::get_routes();

$router->setRoutes($routes);

$router->routeRequest($_SERVER['REQUEST_URI'], 'kapcco\middleware\AuthMiddleware');
