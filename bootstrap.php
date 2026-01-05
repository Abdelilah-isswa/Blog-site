<?php
 // PSR-4 Autoloader
 spl_autoload_register(function ($className) {
     // Remove any leading backslash
     $className = ltrim($className, '\\');
  
     // The base directory
     $baseDir = SRC . '/';
  
     // Build the file path
     $file = $baseDir . str_replace('\\', '/', $className) . '.php';
  
     // Load the file if it exists
     if (file_exists($file)) {
         require $file;
     }
 });


?>