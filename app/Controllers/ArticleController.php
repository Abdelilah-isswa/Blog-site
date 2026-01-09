<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Models\Category;
use App\Models\Like;

class ArticleController extends Controller
{

public function edit($id = null)
{
   
    if (!$id) {
        $id = $_GET['id'] ?? null;
    }
    
   
    
    if (!$id) {
        $_SESSION['error'] = 'Article ID required';
        header('Location: /blog2/public/articles');
        exit;
    }
    
    
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = 'Please login to edit articles';
        header('Location: /blog2/public/login');
        exit;
    }
    

    
  
    $article = Article::find($id);
    
   
  
    
    if (!$article) {
        $_SESSION['error'] = 'Article not found';
        header('Location: /blog2/public/articles');
        exit;
    }
    
    
    $isAuthor = ($_SESSION['user_id'] == ($article['author_id'] ?? null));
    $isAdmin = ($_SESSION['user_role'] ?? 'Reader') === 'Admin';
    
  
    
    if (!$isAuthor && !$isAdmin) {
        $_SESSION['error'] = 'You can only edit your own articles';
        header('Location: /blog2/public/article?id=' . $id);
        exit;
    }
    
    
    $categories = Category::getAll() ?? [];
  
    
    $this->view('article_edit', [
        'title' => 'Edit Article: ' . $article['title'],
        'article' => $article,
        'categories' => $categories,
        'user' => [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'] ?? 'User',
            'role' => $_SESSION['user_role'] ?? 'Reader'
        ]
    ]);
}


public function update($id = null)
{
    if (!$id && isset($_POST['id'])) {
        $id = $_POST['id'];
    }
    
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header('Location: /blog2/public/login');
        exit;
    }
    
    // Get the article
    $article = Article::find($id);
    
    if (!$article) {
        $_SESSION['error'] = 'Article not found';
        header('Location: /blog2/public/articles');
        exit;
    }
    
    // Check if user is author or admin
    $isAuthor = ($_SESSION['user_id'] == $article['author_id']);
    $isAdmin = ($_SESSION['user_role'] ?? 'Reader') === 'Admin';
    
    if (!$isAuthor && !$isAdmin) {
        $_SESSION['error'] = 'You can only edit your own articles';
        header('Location: /blog2/public/article?id=' . $id);
        exit;
    }
    
    // Get form data
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $category_id = $_POST['category_id'] ?? null;
    
    // Validation
    if (empty($title) || empty($content)) {
        $_SESSION['error'] = 'Title and content are required';
        header('Location: /blog2/public/article/edit?id=' . $id);
        exit;
    }
    
    // Update article data
    $updateData = [
        'title' => $title,
        'content' => $content,
        'categorie_id' => $category_id ?: null
    ];
    
    // Update in database (you'll need to create Article::update() method)
    $result = Article::update($id, $updateData);
    
    if ($result) {
        $_SESSION['success'] = 'Article updated successfully!';
        header('Location: /blog2/public/article?id=' . $id);
        exit;
    } else {
        $_SESSION['error'] = 'Failed to update article';
        header('Location: /blog2/public/article/edit?id=' . $id);
        exit;
    }
}

   
public function create()
{
    
    if (!isset($_SESSION['user_id'])) {
        header('Location: /blog2/public/login');
        exit;
    }
    
    if ($_SESSION['user_role'] !== 'Author' && $_SESSION['user_role'] !== 'Admin') {
        $_SESSION['error'] = 'Only Authors and Admins can create articles';
        header('Location: /blog2/public/');
        exit;
    }
    
    
    $categories = Category::getAll() ?? [];
     
   
   
    $this->view('article_create', [
        'title' => 'Create New Article',
        'categories' => $categories,
        'user' => [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'] ?? 'User',
            'role' => $_SESSION['user_role'] ?? 'Reader'
        ]
    ]);
}


public function store()
{
    // Check if user is logged in and is Author/Admin
    if (!isset($_SESSION['user_id'])) {
        header('Location: /blog2/public/login');
        exit;
    }
    
    if ($_SESSION['user_role'] !== 'Author' && $_SESSION['user_role'] !== 'Admin') {
        $_SESSION['error'] = 'Only Authors and Admins can create articles';
        header('Location: /blog2/public/');
        exit;
    }
    
    // Get form data
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $category_id = $_POST['category_id'] ?? null;
    $excerpt = $_POST['excerpt'] ?? substr($content, 0, 200);
    
    // Validation
    if (empty($title) || empty($content)) {
        $_SESSION['error'] = 'Title and content are required';
        header('Location: /blog2/public/article/create');
        exit;
    }
    
    // Create article data
    $articleData = [
        'title' => $title,
        'content' => $content,
        
        'author_id' => $_SESSION['user_id'],
        'categorie_id' => $category_id ?: null
    ];
    
    // Save to database (you'll need to create Article::create() method)
    $result = Article::create($articleData);
    
    if ($result) {
        $_SESSION['success'] = 'Article created successfully!';
        header('Location: /blog2/public/articles');
        exit;
    } else {
        $_SESSION['error'] = 'Failed to create article. Please try again.';
        header('Location: /blog2/public/article/create');
        exit;
    }
}
public function index()
{
    $categories = Category::getAll();
    $articles = Article::getAll(); 
    
    $this->view('articles', [
        'articles' => $articles,
        'categories' => $categories,
        'title' => 'All Articles'
    ]);
}

    public function show($id = null)
    {
        if (!$id && isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        
        $article = Article::find($id);
        
        if (!$article) {
            $this->view('pages/404', ['message' => 'Article not found']);
            return;
        }
        
        $comments = Comment::getByArticle($id);
        $commentCount = Comment::countByArticle($id);
        $likeCount = Like::countByArticle($id);
        $author = User::find($article['author_id']);
        
        $category = null;
        if ($article['categorie_id']) {
            $category = Category::find($article['categorie_id']);
        }
        
        // Check if current user liked this article
        $isLiked = false;
        if (isset($_SESSION['user_id'])) {
            $isLiked = Like::isLiked($_SESSION['user_id'], $id);
        }
        
        $this->view('article_show', [
            'article' => $article, 
            'title' => $article['title'],
            'comments' => $comments,
            'commentCount' => $commentCount,
            'likeCount' => $likeCount,
            'author' => $author,
            'category' => $category,
            'isLiked' => $isLiked,
              'user' => isset($_SESSION['user_id']) ? [
        'id' => $_SESSION['user_id'],
        'username' => $_SESSION['user_name'] ?? 'User',
        'name' => $_SESSION['user_name'] ?? 'User', // Add this line
        'email' => $_SESSION['user_email'] ?? '',
        'role' => $_SESSION['user_role'] ?? 'Reader']:null
        ]);
    }
    
    public function byCategory($categoryId = null)
    {
        if (!$categoryId && isset($_GET['category_id'])) {
            $categoryId = $_GET['category_id'];
        }
        
        $category = Category::find($categoryId);
        
        if (!$category) {
            $this->view('pages/404', ['message' => 'Category not found']);
            return;
        }
        
        $articles = Article::getByCategory($categoryId);
        
        $this->view('pages/articles_category', [
            'articles' => $articles,
            'category' => $category,
            'title' => 'Articles in ' . $category['categorie_name']
        ]);
    }


public function delete($id = null)
{
    if (!$id && isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    
    
    
    if (!$id) {
        $_SESSION['error'] = 'Article ID required';
        header('Location: /blog2/public/articles');
        exit;
    }
    
   
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = 'Please login to delete articles';
        header('Location: /blog2/public/login');
        exit;
    }
    
   
    

    $article = Article::find($id);
    
    if (!$article) {
        $_SESSION['error'] = 'Article not found';
        header('Location: /blog2/public/articles');
        exit;
    }
    
    
  
    $isAuthor = ($_SESSION['user_id'] == ($article['author_id'] ?? null));
    $isAdmin = ($_SESSION['user_role'] ?? 'Reader') === 'Admin';
    
  
    
    if (!$isAuthor && !$isAdmin) {
        $_SESSION['error'] = 'You can only delete your own articles';
        header('Location: /blog2/public/article?id=' . $id);
        exit;
    }
    
    
    $result = Article::delete($id);
    
    if ($result) {
        $_SESSION['success'] = 'Article deleted successfully!';
        header('Location: /blog2/public/');
        exit;
        
    } else {
        $_SESSION['error'] = 'Failed to delete article';
        header('Location: /blog2/public/article?id=' . $id);
        exit;
    }
    
    
}
public function myArticles()
{
   
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = 'Please login to view your articles';
        header('Location: /blog2/public/login');
        exit;
    }
    

    $articles = Article::getByAuthor($_SESSION['user_id']);
    
    
    $categories = Category::getAll();
    
    $this->view('articles', [
        'articles' => $articles,
        'categories' => $categories,
        'title' => 'My Articles',
        'user' => [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['user_name'] ?? 'User',
            'name' => $_SESSION['user_name'] ?? 'User',
            'role' => $_SESSION['user_role'] ?? 'Reader'
        ]
    ]);
}


}