<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
      
        $articles = Article::getAll();
        
       
        $categories = Category::getAll() ?? [];
        
      
        $featuredArticles = array_slice($articles, 0, 3);

    $user = null;
if (isset($_SESSION['user_id']) && $_SESSION['user_id']) {
    $user = [
        'id' => $_SESSION['user_id'],
        'name' => $_SESSION['user_name'] ?? 'User',
        'username' => $_SESSION['user_name'] ?? 'User', 
        'role' => $_SESSION['user_role'] ?? 'Reader'
    ];
}






        
        $this->view('home', [
            'title' => 'Home - Blog Platform',
            'articles' => $articles,
            'featuredArticles' => $featuredArticles,
            'categories' => $categories,
            'user' => $user
        ]);
    }
}