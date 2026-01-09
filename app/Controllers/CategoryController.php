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
public function store()
{
  
   
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
     
        $_SESSION['error'] = 'Only admins can create categories';
        header('Location: /blog2/public/');
        exit;
    }
    
   
    
  
    $categorie_name = trim($_POST['categorie_name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    

    

    if (empty($categorie_name)) {
        echo "<p>DEBUG: Validation failed - category name empty</p>";
        $_SESSION['error'] = 'Category name is required';
        header('Location: /blog2/public/categories/create');
        exit;
    }
    
    echo "<p>DEBUG: Validation passed</p>";
    
 
    $existingCategory = Category::findByName($categorie_name);
    if ($existingCategory) {
        echo "<p>DEBUG: Category already exists</p>";
        $_SESSION['error'] = 'Category already exists';
        header('Location: /blog2/public/categories/create');
        exit;
    }
    
    echo "<p>DEBUG: Category doesn't exist - creating</p>";
    
  
    $categoryData = [
        'categorie_name' => $categorie_name,
        'description' => $description ?: null,
        'creator_id' => $_SESSION['user_id']
    ];
    
    echo "<p>DEBUG: Category data to save:</p>";
    echo "<pre>";
    print_r($categoryData);
    echo "</pre>";
    
   
    $result = Category::create($categoryData);
    
    echo "<p>DEBUG: Category::create() returned: " . ($result ? 'TRUE' : 'FALSE') . "</p>";
    
    if ($result) {
        echo "<p>DEBUG: Success - redirecting to categories list</p>";
        $_SESSION['success'] = 'Category created successfully!';
        header('Location: /blog2/public/categories');
        exit;
    } else {
        echo "<p>DEBUG: Failed to create category</p>";
        $_SESSION['error'] = 'Failed to create category. Please try again.';
        header('Location: /blog2/public/categories/create');
        exit;
    }
}
    
  public function edit($id = null)
{
    // ADD THIS DEBUG CODE:
    echo "<div style='background: #fff3cd; padding: 15px; margin: 20px; border: 2px solid #ffc107;'>";
    echo "<h3>🛠️ DEBUG: CategoryController::edit()</h3>";
    
    if (!$id) {
        $id = $_GET['id'] ?? null;
    }
    
    echo "<p><strong>🔍 ID received:</strong> " . ($id ? $id : 'NULL') . "</p>";
    echo "<p><strong>📋 \$_GET['id']:</strong> " . ($_GET['id'] ?? 'NOT SET') . "</p>";
    
    // Rest of your existing code...
    // Check if user is admin
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
        echo "<p><strong>❌ ERROR:</strong> User not admin</p>";
        $_SESSION['error'] = 'Only admins can edit categories';
        header('Location: /blog2/public/');
        exit;
    }
    
    if (!$id) {
        echo "<p><strong>❌ ERROR:</strong> No ID provided</p>";
        $_SESSION['error'] = 'Category ID required';
        header('Location: /blog2/public/categories');
        exit;
    }
    
    echo "<p><strong>🔍 Looking for category ID $id in database...</strong></p>";
    $category = Category::find($id);
    
    echo "<p><strong>✅ Category found?</strong> " . ($category ? 'YES' : 'NO') . "</p>";
    
    if ($category) {
        echo "<pre><strong>📊 Category data:</strong>\n";
        print_r($category);
        echo "</pre>";
    }
    
    if (!$category) {
        echo "<p><strong>❌ ERROR:</strong> Category not found in DB</p>";
        $_SESSION['error'] = 'Category not found';
        header('Location: /blog2/public/categories');
        exit;
    }
    
    echo "<p><strong>🚀 Passing to view:</strong> \$category with ID " . $category['categorie_id'] . "</p>";
    echo "</div>";
    
    // Continue with your existing view code...
    $this->view('creatcategories', [
        'title' => 'Edit Category: ' . $category['categorie_name'],
        'category' => $category,
        'user' => [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'] ?? 'Admin',
            'role' => $_SESSION['user_role'] ?? 'Reader'
        ]
    ]);
}
    
  
    public function update($id = null)
    {
        if (!$id && isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        
        
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
            $_SESSION['error'] = 'Only admins can edit categories';
            header('Location: /blog2/public/');
            exit;
        }
        
        $category = Category::find($id);
        
        if (!$category) {
            $_SESSION['error'] = 'Category not found';
            header('Location: /blog2/public/categories');
            exit;
        }
        
       
        $categorie_name = trim($_POST['categorie_name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        
        
        if (empty($categorie_name)) {
            $_SESSION['error'] = 'Category name is required';
            header('Location: /blog2/public/categories/edit?id=' . $id);
            exit;
        }
        
       
        $existingCategory = Category::findByName($categorie_name);
        if ($existingCategory && $existingCategory['categorie_id'] != $id) {
            $_SESSION['error'] = 'Category name already exists';
            header('Location: /blog2/public/categories/edit?id=' . $id);
            exit;
        }
        
        
        $updateData = [
            'categorie_name' => $categorie_name,
            'description' => $description ?: null
        ];
        
        $result = Category::update($id, $updateData);
        
        if ($result) {
            $_SESSION['success'] = 'Category updated successfully!';
            header('Location: /blog2/public/categories');
            exit;
        } else {
            $_SESSION['error'] = 'Failed to update category';
            header('Location: /blog2/public/categories/edit?id=' . $id);
            exit;
        }
    }
    
    
    public function delete($id = null)
    {
        if (!$id) {
            $id = $_GET['id'] ?? null;
        }
        
       
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
            $_SESSION['error'] = 'Only admins can delete categories';
            header('Location: /blog2/public/');
            exit;
        }
        
        if (!$id) {
            $_SESSION['error'] = 'Category ID required';
            header('Location: /blog2/public/categories');
            exit;
        }
        
        $category = Category::find($id);
        
        if (!$category) {
            $_SESSION['error'] = 'Category not found';
            header('Location: /blog2/public/categories');
            exit;
        }
        
       
        $articles = Article::getByCategory($id);
        if (count($articles) > 0) {
            $_SESSION['error'] = 'Cannot delete category that has articles. Please reassign or delete articles first.';
            header('Location: /blog2/public/categories');
            exit;
        }
        
        $result = Category::delete($id);
        
        if ($result) {
            $_SESSION['success'] = 'Category deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete category';
        }
        
        header('Location: /blog2/public/categories');
        exit;
    }

}