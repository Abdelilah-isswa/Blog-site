<?php
namespace Core;

class Router {
    
    public function dispatch($url) {
       
        $parts = explode('/', $url);
        
       
        $controllerName = 'HomeController';
        if (!empty($parts[0])) {
            $controllerName = ucfirst($parts[0]) . 'Controller';
        }
        
        
        $method = 'index';
        if (!empty($parts[1])) {
            $method = $parts[1];
        }
        
       
        $params = array_slice($parts, 2);
        
        // Debug output
        if (defined('APP_DEBUG') && APP_DEBUG) {
            echo "<div style='background:#e8f4f8; padding:15px; margin:10px; border:1px solid #b6d4e3;'>";
            echo "<h4 style='margin-top:0;'>Router Information</h4>";
            echo "<strong>Controller:</strong> $controllerName<br>";
            echo "<strong>Method:</strong> $method<br>";
            echo "<strong>Parameters:</strong> " . implode(', ', $params) . "<br>";
            echo "</div>";
        }
        
       
        $controllerClass = "\\Controllers\\" . $controllerName;
        
        
        if (!class_exists($controllerClass)) {
            $this->notFound("Controller '$controllerName' not found");
        }
        
        
        $controller = new $controllerClass();
        
        
        if (!method_exists($controller, $method)) {
            $this->notFound("Method '$method' not found in $controllerName");
        }
        
        
        call_user_func_array([$controller, $method], $params);
    }
    
    private function notFound($message = '') {
        http_response_code(404);
        
        
        $viewFile = VIEWS . '/errors/404.php';
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            echo "<h1>404 - Page Not Found</h1>";
            if ($message && defined('APP_DEBUG') && APP_DEBUG) {
                echo "<p><small>$message</small></p>";
            }
        }
        exit();
    }
}
?>