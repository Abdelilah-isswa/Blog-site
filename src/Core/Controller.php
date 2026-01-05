<?php
namespace Core;

class Controller {
    
   
    protected function view($view, $data = []) {
        
        extract($data);
        
        
        ob_start();
        
        
        $viewFile = VIEWS . '/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            die("View '$view' not found at: $viewFile");
        }
        
        
        $content = ob_get_clean();
        
        
        $layoutFile = VIEWS . '/layouts/main.php';
        if (file_exists($layoutFile)) {
            require $layoutFile;
        } else {
           
            echo $content;
        }
    }
    protected function url($path = '') {
    
    $base = dirname($_SERVER['SCRIPT_NAME']);
    
    if ($base === '/') {
        return '/' . ltrim($path, '/');
    } else {
        return $base . '/' . ltrim($path, '/');
    }
}
   
    protected function model($model) {
        $modelClass = "\\Models\\" . $model;
        
        if (class_exists($modelClass)) {
            return new $modelClass();
        } else {
            die("Model '$model' not found");
        }
    }
    
    
    protected function redirect($url) {
        header("Location: $url");
        exit();
    }
}
?>