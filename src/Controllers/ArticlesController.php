<?php
namespace Controllers;

use Core\Controller;

class ArticlesController extends Controller {
    
    public function index() {
        echo "<h1>All Articles</h1>";
        echo "<p>Articles page is working!</p>";
        echo "<p><a href='/blog/'>← Back to Home</a></p>";
    }
    public function show($id){
        echo "showing article id: ". htmlspecialchars($id) ;
    }
}
?>