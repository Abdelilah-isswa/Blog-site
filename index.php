<?php

session_start();

// 2. Define paths
define('ROOT', __DIR__);
define('SRC', ROOT . '/src');
define('APP', ROOT . '/app');
define('VIEWS', APP . '/views');
define('PUBLIC_DIR', APP . '/public');

// 3. Development mode
define('APP_DEBUG', true);

if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// 4. SIMPLE AUTOLOADER THAT WORKS
spl_autoload_register(function ($className) {
    // Remove namespace backslash
    $className = ltrim($className, '\\');
    
    // Convert namespace to file path
    // Core\Router → src/Core/Router.php
    // Controllers\HomeController → src/Controllers/HomeController.php
    $file = SRC . '/' . str_replace('\\', '/', $className) . '.php';
    
    // Debug
    if (APP_DEBUG) {
        error_log("Autoloader trying: $className → $file");
    }
    
    if (file_exists($file)) {
        require_once $file;
    } else {
        // For debugging
        if (APP_DEBUG) {
            echo "<div style='color:red; padding:10px; margin:10px; border:1px solid red;'>";
            echo "<strong>Class not found:</strong> $className<br>";
            echo "<strong>Looking for:</strong> $file<br>";
            echo "</div>";
        }
    }
});

// 5. Get current URL
$request = $_SERVER['REQUEST_URI'];
$script = $_SERVER['SCRIPT_NAME'];

// Remove base path
$base = dirname($script);
$path = str_replace($base, '', $request);

// Remove query string
$path = parse_url($path, PHP_URL_PATH);

// Clean up
$url = trim($path, '/');

// Default route
if (empty($url)) {
    $url = 'home/index';
}

// Debug output
if (APP_DEBUG) {
    echo "<div style='background:#f8f9fa; padding:15px; margin:10px; border:1px solid #ddd;'>";
    echo "<h4 style='margin-top:0;'>Debug Information</h4>";
    echo "<strong>REQUEST_URI:</strong> $request<br>";
    echo "<strong>SCRIPT_NAME:</strong> $script<br>";
    echo "<strong>Base Path:</strong> $base<br>";
    echo "<strong>Final URL:</strong> $url<br>";
    echo "</div>";
}

// 6. Create and run router
try {
    $router = new Core\Router();
    $router->dispatch($url);
    
} catch (Exception $e) {
    if (APP_DEBUG) {
        die("<h1>Error</h1><pre>" . $e->getMessage() . "</pre>");
    } else {
        die("<h1>500 - Internal Server Error</h1>");
    }
}
?>