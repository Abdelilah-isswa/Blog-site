<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{

        public function index()
    {
        
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
            $_SESSION['error'] = 'Only admins can manage categories';
            header('Location: /blog2/public/');
            exit;
        }
        
        $categories = Category::getCategoriesWithCount();
        
        $this->view('categories', [
            'title' => 'Manage Categories',
            'categories' => $categories,
            'user' => [
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'] ?? 'Admin',
                'role' => $_SESSION['user_role'] ?? 'Reader'
            ]
        ]);
    }

    public function create()
    {
        
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
            $_SESSION['error'] = 'Only admins can create categories';
            header('Location: /blog2/public/');
            exit;
        }
        
        $this->view('creatcategories', [
            'title' => 'Create New Category',
            'user' => [
                'id' => $_SESSION['user_id'],
                'name' => $_SESSION['user_name'] ?? 'Admin',
                'role' => $_SESSION['user_role'] ?? 'Reader'
            ]
        ]);
    }


}