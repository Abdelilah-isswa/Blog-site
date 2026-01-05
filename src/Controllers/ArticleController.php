<?php
namespace Controllers;

use Core\Controller;

class ArticleController extends Controller {
    
    public function index() {
        $baseUrl = $this->getBaseUrl();
        
        echo "<h1>Articles Page</h1>";
        echo "<p>This would show all articles</p>";
        
        echo "<ul>";
        for ($i = 1; $i <= 10; $i++) {
            echo "<li><a href='{$baseUrl}/articles/show/{$i}'>Article {$i}</a></li>";
        }
        echo "</ul>";
        
        echo "<p><a href='{$baseUrl}/'>← Back to Home</a></p>";
    }
    
    public function show($id) {
        $baseUrl = $this->getBaseUrl();
        
        echo "<h1>Article #{$id}</h1>";
        echo "<p>This is the content of article {$id}...</p>";
        echo "<p><a href='{$baseUrl}/articles'>← Back to Articles</a></p>";
        echo "<p><a href='{$baseUrl}/'>← Back to Home</a></p>";
    }
    
    private function getBaseUrl() {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $script = $_SERVER['SCRIPT_NAME'];
        $projectFolder = dirname($script);
        
        return $protocol . '://' . $host . $projectFolder;
    }
}
?>