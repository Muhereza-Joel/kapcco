<?php

namespace kapcco\core;

class Route
{

    private static $routes = [];

    public static function init()
    {
        include_once __DIR__ . '/http/web.php';
    }

    public static function get_routes()
    {
        return self::$routes;
    }

    public static function add($path, $controllerMethod, $methods = ['GET'])
    {
        self::$routes[] = [
            'path' => $path,
            'controllerMethod' => $controllerMethod,
            'methods' => $methods,
        ];
    }

    public static function get($path, $controllerMethod)
    {
        self::add($path, $controllerMethod, ['GET']);
    }

    public static function post($path, $controllerMethod)
    {
        self::add($path, $controllerMethod, ['POST']);
    }
}
