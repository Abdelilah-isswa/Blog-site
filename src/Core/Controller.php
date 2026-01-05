<?php
namespace Core;

class Controller {
    
    // Load a view
    protected function view($view, $data = []) {
        // Extract data to variables
        extract($data);
        
        // Start output buffering
        ob_start();
        
        // Include the view file
        $viewFile = VIEWS . '/' . $view . '.php';
        
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            die("View '$view' not found at: $viewFile");
        }
        
        // Get the buffered content
        $content = ob_get_clean();
        
        // Include layout if it exists
        $layoutFile = VIEWS . '/layouts/main.php';
        if (file_exists($layoutFile)) {
            require $layoutFile;
        } else {
            // If no layout, just output the content
            echo $content;
        }
    }
    protected function url($path = '') {
    // Get base path
    $base = dirname($_SERVER['SCRIPT_NAME']);
    
    if ($base === '/') {
        return '/' . ltrim($path, '/');
    } else {
        return $base . '/' . ltrim($path, '/');
    }
}
    // Load a model
    protected function model($model) {
        $modelClass = "\\Models\\" . $model;
        
        if (class_exists($modelClass)) {
            return new $modelClass();
        } else {
            die("Model '$model' not found");
        }
    }
    
    // Redirect
    protected function redirect($url) {
        header("Location: $url");
        exit();
    }
}
?>