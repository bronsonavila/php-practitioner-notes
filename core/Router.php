<?php

namespace App\Core;

class Router
{
    // Stores routes (by type) that have been defined on the router instance:
    public $routes = [
        'GET' => [],
        'POST' => [],
    ];

    // A static function is not an instance method, but is rather like a
    // a global method that can be called at any time:
    public static function load($file)
    {
        // Makes the $router variable available:
        $router = new static; // Keyword "static" creates a new instance.
        require $file;
        return $router;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    // Directs traffic from a URI to its associated controller:
    public function direct($uri, $requestType)
    {
        // First argument is the key to find; second is the array to search:
        if (!array_key_exists($uri, $this->routes[$requestType])) {
            throw new Exception('No route defined for this URI.');
        }

        // Changes, e.g., "PagesController@home" to ["PagesController", "home"]:
        $arguments = explode('@', $this->routes[$requestType][$uri]);

        return $this->callAction(...$arguments);
    }

    // Protected because no other operation outside of this class will use it:
    protected function callAction($controller, $action)
    {
        // Add namespacing to the controller, and use double backslashes to
        // prevent the usage of a single backslash as an escape character:
        $namespacedController = "App\\Controllers\\{$controller}";

        $controller = new $namespacedController;

        if (!method_exists($controller, $action)) {
            throw new Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }

        return $controller->$action();
    }
}
