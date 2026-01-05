<?php
namespace Controllers;

use Core\Controller;

class HomeController extends Controller {
    
public function index() {
    
    echo "<p>HomeController loaded successfully!</p>";
    
    echo "<div style='background:#d4edda; padding:15px; margin:10px; border-radius:5px;'>";
    echo "<h3>Test Links:</h3>";
    echo "<ul>";
    echo "<li><a href='" . $this->url() . "'>Home</a></li>";
    echo "<li><a href='" . $this->url('home/test') . "'>Test Method</a></li>";
    echo "<li><a href='" . $this->url('home/about') . "'>About Page</a></li>";
    echo "<li><a href='" . $this->url('articles') . "'>Articles</a></li>";
    echo "<li><a href='" . $this->url('articles/show/5') . "'>Article 5</a></li>";
    echo "</ul>";
    echo "</div>";
}
    
    public function test() {
        $baseUrl = $this->getBaseUrl();
        
        echo "<h1>Test Page</h1>";
        echo "<p>This is a test method in HomeController</p>";
        echo "<p>Everything is working correctly!</p>";
        echo "<p><a href='{$baseUrl}/'>← Back to Home</a></p>";
    }
    
    public function about() {
        $baseUrl = $this->getBaseUrl();
        
        $data = [
            'title' => 'About Us',
            'content' => 'This is the about page showing that MVC routing works!',
            'baseUrl' => $baseUrl
        ];
        
        $this->view('home/about', $data);
    }
    
    // Helper method to get base URL
    private function getBaseUrl() {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $script = $_SERVER['SCRIPT_NAME'];
        
        // Get project folder from script name
        $projectFolder = dirname($script);
        
        if ($projectFolder === '/') {
            return $protocol . '://' . $host;
        } else {
            return $protocol . '://' . $host . $projectFolder;
        }
    }
}
?>