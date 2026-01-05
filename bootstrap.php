<?php

 spl_autoload_register(function ($className) {
    
     $className = ltrim($className, '\\');
  
     
     $baseDir = SRC . '/';
  
    
     $file = $baseDir . str_replace('\\', '/', $className) . '.php';
  
    
     if (file_exists($file)) {
         require $file;
     }
 });


?>