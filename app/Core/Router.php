<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function __construct()
    {
        
    }

    public function get(string $uri, string $action){
        $this->routes['GET'][$uri] = $action;
    }

    public function post(string $uri, string $action){
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //   /blog2/public/
       


        $requestMethod = $_SERVER['REQUEST_METHOD'];  //GET
      
        if (isset($this->routes[$requestMethod][$uri])) {
           
            [$controllerName, $methodName] = explode('@', $this->routes[$requestMethod][$uri]);

            $controllerClass = "App\\Controllers\\$controllerName";
            $controller = new $controllerClass();
            $controller->$methodName();
            return;
        }

        $controllerClass = "App\\Controllers\\NotFoundController";
        $controller = new $controllerClass();
        $controller->index();
    }
}