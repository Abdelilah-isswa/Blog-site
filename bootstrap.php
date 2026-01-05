<?php
define('ROOT',__DIR__);
define('APP',ROOT.'/app');
define('CONFIG',ROOT.'/config');
define('CORE',ROOT.'/core');
define('PUBLIC',ROOT.'/public');
define('VIEWS',APP.'/views');
spl_autoload_register(function($class){
    $base_dir = APP .'/';
    $file = $base_dir .str_replace('\\','/',$class).'php';

    //file exists
    if(file_exists($file)){

        require $file;
    };
});

session_start();
require_once CONFIG.'/database.php';







echo $base_dir;