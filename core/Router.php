<?php

namespace kapcco\core;

class Router
{
    private $routes = [];
    private $defaultRoute;

    public function setDefaultRoute($controllerMethod)
    {
        $this->defaultRoute = $controllerMethod;
    }

    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    public function routeRequest($path, $middlewareClass, $method = 'POST')
    {
        $this->handleRequest($path, $middlewareClass, $method);
    }

    private function handleRequest($requestedUrl, $middlewareClass = null, $method = 'GET')
    {
        // Check if the user is logged in when accessing the base URL
        if ($requestedUrl === '/kapcco/' && Session::isLoggedIn()) {
            $this->handleRegularRouteLogic('/kapcco/dashboard/', 'kapcco\controller\DashboardController', 'index');
            return;
        }

        // Remove query string parameters from the URL
        $urlParts = explode('?', $requestedUrl);
        $path = $urlParts[0];

        // Check if the route exists for the given HTTP method
        $matchingRoutes = array_filter($this->routes, function ($route) use ($path, $method) {
            return $route['path'] === $path && in_array($method, $route['methods']);
        });

        if (!empty($matchingRoutes)) {
            $route = reset($matchingRoutes);
            // Split the controller and method
            list($controllerName, $methodName) = explode('@', $route['controllerMethod']);

            // Apply middleware if provided
            if ($middlewareClass !== null) {
                $this->applyMiddlewareLogic($middlewareClass, $path, $controllerName, $methodName);
            } else {
                // No middleware, proceed with regular route logic
                // $this->handleRegularRouteLogic($path, $controllerName, $methodName);
                echo $path;
                echo $controllerName;
                echo $methodName;
            }
        } else {
            // Use the default route if no matching route is found
            if (!empty($this->defaultRoute)) {
                list($controllerName, $methodName) = explode('@', $this->defaultRoute);
                $controller = new $controllerName();
                call_user_func([$controller, $methodName]);
            } else {
                // Handle 404 Not Found error
                header("HTTP/1.0 404 Not Found");
                echo "404 Not Found";
            }
        }
    }

    private function handleRegularRouteLogic($path)
    {
        // Find the route that matches the specified path
        $matchingRoute = null;
        foreach ($this->routes as $route) {
            if ($route['path'] === $path) {
                $matchingRoute = $route;
                break;
            }
        }

        // Check if a matching route was found
        if ($matchingRoute !== null) {
            // Extract individual details
            $controllerMethod = $matchingRoute['controllerMethod'];
            $methods = $matchingRoute['methods'];

            // Split the controller and method
            list($controllerName, $methodName) = explode('@', $controllerMethod);

            if (!empty($controllerName) && class_exists($controllerName)) {
                $controller = new $controllerName();

                // Extract route parameters from the URL
                $routeParams = $this->extractRouteParameters($path, $_SERVER['REQUEST_URI']);

                // Call the controller method and pass route parameters
                call_user_func_array([$controller, $methodName], $routeParams);
            }
        } else {
            // If the route is not found, return a 404 response
            header("HTTP/1.0 404 Not Found");
            echo "404 Not Found";
        }
    }


    private function applyMiddlewareLogic($middlewareClass, $path, $controllerName, $methodName)
    {
        // Create an instance of the middleware
        $middleware = new $middlewareClass();

        // Check if the middleware allows access
        if ($middleware->handle()) {
            // Continue with regular route logic
            $this->handleRegularRouteLogic($path, $controllerName, $methodName);
        } else {
            // Handle unauthorized access (e.g., redirect to login page)
            header('Location: /kapcco/auth/login/');
            exit();
        }
    }

    // Extract route parameters from the URL
    private function extractRouteParameters($routePath, $requestedUrl)
    {
        $routeParams = [];

        // Remove the base route path to get only the parameters
        $pathWithoutBase = rtrim(str_replace($routePath, '', $requestedUrl), '/');

        // Split the remaining path into segments
        $pathSegments = explode('/', $pathWithoutBase);

        // Define placeholders in the route path
        $routeSegments = explode('/', $routePath);

        // Add each segment as a parameter or extract variable from placeholder
        foreach ($pathSegments as $index => $segment) {
            $placeholder = trim($routeSegments[$index], "{}");

            // If it's a placeholder, use the placeholder name as the variable name
            if ($placeholder !== '') {
                $routeParams[$placeholder] = $segment;
            }
        }

        // Parse query string parameters
        $queryString = parse_url($requestedUrl, PHP_URL_QUERY);
        parse_str($queryString, $queryParameters);

        // Merge query string parameters with path parameters
        $routeParams = array_merge($routeParams, $queryParameters);

        return $routeParams;
    }
}
