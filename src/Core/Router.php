<?php
namespace Core;

class Router {
    
    public function dispatch($url) {
        // Split URL into parts
        $parts = explode('/', $url);
        
        // Get controller name (first part)
        $controllerName = 'HomeController';
        if (!empty($parts[0])) {
            $controllerName = ucfirst($parts[0]) . 'Controller';
        }
        
        // Get method name (second part)
        $method = 'index';
        if (!empty($parts[1])) {
            $method = $parts[1];
        }
        
        // Get parameters (rest of the parts)
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
        
        // Build full controller class name
        $controllerClass = "\\Controllers\\" . $controllerName;
        
        // Check if controller exists
        if (!class_exists($controllerClass)) {
            $this->notFound("Controller '$controllerName' not found");
        }
        
        // Create controller instance
        $controller = new $controllerClass();
        
        // Check if method exists
        if (!method_exists($controller, $method)) {
            $this->notFound("Method '$method' not found in $controllerName");
        }
        
        // Call the controller method with parameters
        call_user_func_array([$controller, $method], $params);
    }
    
    private function notFound($message = '') {
        http_response_code(404);
        
        // Try to load 404 view
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