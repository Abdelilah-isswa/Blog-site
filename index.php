<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Define base paths
define('ROOT', __DIR__);


define('SRC', ROOT . '/src');
define('CORE', SRC . '/Core');
define('CONTROLLERS', SRC . '/Controllers');
define('MODELS', SRC . '/models');

// APPLICATION (Config, Views, Public)
define('APP', ROOT . '/app');
define('CONFIG', APP . '/config');
define('PUBLIC_DIR', APP . '/public');
define('VIEWS', APP . '/views');


define('APP_DEBUG', false);


require 'bootstrap.php';


$request = $_SERVER['REQUEST_URI'];
$script = $_SERVER['SCRIPT_NAME'];
$base = dirname($script);
$path = str_replace($base, '', $request);
$path = parse_url($path, PHP_URL_PATH);
$url = trim($path, '/');


if (empty($url)) {
    $url = 'home/index';
}


$router = new Core\Router();
$router->dispatch($url);



?>