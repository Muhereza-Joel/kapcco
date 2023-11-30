<?php
namespace kapcco\core;

class Router{

    private $routes = [];
    
    private $defaultRoute;
    
    public function init_routes(){
        //routes for AuthController
        $this->setDefaultRoute('kapcco\controller\AuthController@index');
        $this->addRoute('/kapcco/auth/register/', 'kapcco\controller\AuthController@render_register_view');
        $this->addRoute('/kapcco/auth/login/', 'kapcco\controller\AuthController@index');
        $this->addRoute('/kapcco/auth/create-profile/', 'kapcco\controller\AuthController@render_create_profile_view');
        $this->addRoute('/kapcco/auth/login/sign-in/', 'kapcco\controller\AuthController@sign_in_user');
        $this->addRoute('/kapcco/auth/create-account/', 'kapcco\controller\AuthController@create_account');
        $this->addRoute('/kapcco/image-upload/', 'kapcco\controller\AuthController@upload_photo');
        $this->addRoute('/kapcco/auth/check-nin/', 'kapcco\controller\AuthController@check_nin');
        $this->addRoute('/kapcco/auth/check-email/', 'kapcco\controller\AuthController@check_email');
        $this->addRoute('/kapcco/auth/check-password/', 'kapcco\controller\AuthController@check_password');
        $this->addRoute('/kapcco/auth/change-password/', 'kapcco\controller\AuthController@change_password');
        $this->addRoute('/kapcco/auth/save-profile/', 'kapcco\controller\AuthController@save_profile');
        $this->addRoute('/kapcco/auth/update-profile/', 'kapcco\controller\AuthController@update_profile');
        $this->addRoute('/kapcco/auth/user/profile/update-photo/', 'kapcco\controller\AuthController@update_photo');
        $this->addRoute('/kapcco/auth/sign-out/', 'kapcco\controller\AuthController@sign_out');
        $this->addRoute('/kapcco/auth/user/profile/', 'kapcco\controller\AuthController@render_show_profile_view');

        //routes for DashboardController
        $this->addRoute('/kapcco/dashboard/', 'kapcco\controller\DashboardController@index');
        $this->addRoute('/kapcco/dashboard/add-collection/', 'kapcco\controller\DashboardController@render_add_collection_view');
        $this->addRoute('/kapcco/dashboard/collections/', 'kapcco\controller\DashboardController@render_collections_view');
        $this->addRoute('/kapcco/dashboard/branches/', 'kapcco\controller\DashboardController@render_branches_view');
        $this->addRoute('/kapcco/dashboard/zones/', 'kapcco\controller\DashboardController@render_zones_view');
        $this->addRoute('/kapcco/dashboard/reports/branch-store/', 'kapcco\controller\DashboardController@render_branch_stores_reports_view');
        $this->addRoute('/kapcco/dashboard/farmers/', 'kapcco\controller\DashboardController@get_all_farmers_view');
        $this->addRoute('/kapcco/dashboard/farmers/u/', 'kapcco\controller\DashboardController@render_farmers_view');
        $this->addRoute('/kapcco/dashboard/farmers/approve/', 'kapcco\controller\DashboardController@approve_all');
        $this->addRoute('/kapcco/dashboard/farmers/assign/', 'kapcco\controller\DashboardController@assign_all');
        $this->addRoute('/kapcco/dashboard/farmers/drop-assignments/', 'kapcco\controller\DashboardController@drop_all_assignments');
        $this->addRoute('/kapcco/collections/u/my-collections/', 'kapcco\controller\DashboardController@render_my_collections_view');
        $this->addRoute('/kapcco/collections/info/', 'kapcco\controller\DashboardController@render_my_collections_info_view');
        
        //routes for BranchController
        $this->addRoute('/kapcco/dashboard/branches/add/', 'kapcco\controller\BranchController@add_branch');
        $this->addRoute('/kapcco/dashboard/branches/edit/', 'kapcco\controller\BranchController@edit_branch');
        $this->addRoute('/kapcco/dashboard/branches/delete/', 'kapcco\controller\BranchController@delete_branch');

        //routes for ZonesController
        $this->addRoute('/kapcco/dashboard/zones/add/', 'kapcco\controller\ZonesController@add_zone');
        $this->addRoute('/kapcco/dashboard/zones/edit/', 'kapcco\controller\ZonesController@edit_zone');
        $this->addRoute('/kapcco/dashboard/zones/delete/', 'kapcco\controller\ZonesController@delete_zone');
        $this->addRoute('/kapcco/dashboard/zones/get-zones-by-id/', 'kapcco\controller\ZonesController@get_zones_by_id');
        $this->addRoute('/kapcco/dashboard/zones/get-farmers-by-store-id/', 'kapcco\controller\ZonesController@get_farmers_by_store_id');
        $this->addRoute('/kapcco/dashboard/zones/get-farmers-collections/', 'kapcco\controller\ZonesController@get_farmer_collections');

        //routes for CollectionsController
        $this->addRoute('/kapcco/dashboard/colllections/add-season/', 'kapcco\controller\CollectionsController@save_season');
        $this->addRoute('/kapcco/dashboard/colllections/set-price-scale/', 'kapcco\controller\CollectionsController@set_price_scale');
        $this->addRoute('/kapcco/dashboard/colllections/get-product-unit-price/', 'kapcco\controller\CollectionsController@get_product_unit_price');
        $this->addRoute('/kapcco/dashboard/colllections/add/', 'kapcco\controller\CollectionsController@add_collection');

    }

    // Define a default route
    public function setDefaultRoute($controllerMethod) {
        $this->defaultRoute = $controllerMethod;
    }

    public function addRoute($path, $controllerMethod){
        $this->routes[$path] = $controllerMethod;

    }

    public function routeRequest($path, $middlewareClass)
    {
        $this->handleRequest($path, $middlewareClass);
    }


    private function handleRequest($requestedUrl, $middlewareClass = null)
    {
        // Check if the user is logged in when accessing the base URL
        if ($requestedUrl === '/kapcco/' && Session::isLoggedIn()) {
            $this->handleRegularRouteLogic('/kapcco/dashboard/', 'kapcco\controller\DashboardController', 'index');
            return;
        }

        // Remove query string parameters from the URL
        $urlParts = explode('?', $requestedUrl);
        $path = $urlParts[0];

        // Check if the route exists
        if (array_key_exists($path, $this->routes)) {
            // Split the controller and method
            list($controllerName, $methodName) = explode('@', $this->routes[$path]);

            // Apply middleware if provided
            if ($middlewareClass !== null) {
                $this->applyMiddlewareLogic($middlewareClass, $path, $controllerName, $methodName);
            } else {
                // No middleware, proceed with regular route logic
                $this->handleRegularRouteLogic($path, $controllerName, $methodName);
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

    private function handleRegularRouteLogic($path, $controllerName, $methodName)
    {
        // Split the controller and method
        list($controllerName, $methodName) = explode('@', $this->routes[$path]);

        // Create an instance of the controller
        $controller = new $controllerName();

        // Extract route parameters from the URL
        $routeParams = $this->extractRouteParameters($path, $_SERVER['REQUEST_URI']);

        // Call the controller method and pass route parameters
        call_user_func_array([$controller, $methodName], $routeParams);
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
    private function extractRouteParameters($routePath, $requestedUrl) {
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

?>