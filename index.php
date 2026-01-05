<?php

session_start();


define('ROOT', __DIR__);
define('SRC', ROOT . '/src');
define('APP', ROOT . '/app');
define('VIEWS', APP . '/views');
define('PUBLIC_DIR', APP . '/public');


define('APP_DEBUG', true);




require 'bootstrap.php';









$request = $_SERVER['REQUEST_URI'];
$script = $_SERVER['SCRIPT_NAME'];


$base = dirname($script);
$path = str_replace($base, '', $request);


$path = parse_url($path, PHP_URL_PATH);


$url = trim($path, '/');

// Default route
if (empty($url)) {
    $url = 'home/index';
}






    $router = new Core\Router();
    $router->dispatch($url);
    

?>