<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Comment;
use App\Models\Article;

class CommentController extends Controller
{
   
    public function update($id = null)
    {
        if (!$id) {
            $id = $_POST['id'] ?? $_GET['id'] ?? null;
        }
        
       
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Please login to update comments';
            header('Location: /blog/public/login');
            exit;
        }
        
        $comment = Comment::find($id);
        
        if (!$comment) {
            $_SESSION['error'] = 'Comment not found';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/blog/public/'));
            exit;
        }
        
     
        $isOwner = ($_SESSION['user_id'] == $comment['user_id']);
        $isAdmin = ($_SESSION['user_role'] ?? 'Reader') === 'Admin';
        
        if (!$isOwner && !$isAdmin) {
            $_SESSION['error'] = 'You can only update your own comments';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/blog/public/'));
            exit;
        }
        
        
        $content = trim($_POST['content'] ?? '');
        
       
        if (empty($content)) {
            $_SESSION['error'] = 'Comment content is required';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/blog/public/'));
            exit;
        }
        
       
        $result = Comment::update($id, $content);
        
        if ($result) {
            $_SESSION['success'] = 'Comment updated successfully!';
        } else {
            $_SESSION['error'] = 'Failed to update comment';
        }
        
       
        header('Location: /blog/public/article?id=' . $comment['article_id']);
        exit;
    }
    
    
    public function delete($id = null)
    {
        if (!$id) {
            $id = $_GET['id'] ?? null;
        }
        
       
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Please login to delete comments';
            header('Location: /blog/public/login');
            exit;
        }
        
        $comment = Comment::find($id);
        
        if (!$comment) {
            $_SESSION['error'] = 'Comment not found';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/blog/public/'));
            exit;
        }
        
    
        $isOwner = ($_SESSION['user_id'] == $comment['user_id']);
        $isAdmin = ($_SESSION['user_role'] ?? 'Reader') === 'Admin';
        
        if (!$isOwner && !$isAdmin) {
            $_SESSION['error'] = 'You can only delete your own comments';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/blog/public/'));
            exit;
        }
        
        
        $articleId = $comment['article_id'];
        
       
        $result = Comment::delete($id);
        
        if ($result) {
            $_SESSION['success'] = 'Comment deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete comment';
        }
        
      
        header('Location: /blog/public/article?id=' . $articleId);
        exit;
    }
    
    
    public function edit($id = null)
    {
        if (!$id) {
            $id = $_GET['id'] ?? null;
        }
        
        
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Please login to edit comments';
            header('Location: /blog/public/login');
            exit;
        }
        
        $comment = Comment::find($id);
        
        if (!$comment) {
            $_SESSION['error'] = 'Comment not found';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/blog/public/'));
            exit;
        }
        
       
        $isOwner = ($_SESSION['user_id'] == $comment['user_id']);
        $isAdmin = ($_SESSION['user_role'] ?? 'Reader') === 'Admin';
        
        if (!$isOwner && !$isAdmin) {
            $_SESSION['error'] = 'You can only edit your own comments';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/blog/public/'));
            exit;
        }
        
        
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            echo json_encode($comment);
            exit;
        }
        
      
        $_SESSION['editing_comment_id'] = $id;
        header('Location: /blog/public/article?id=' . $comment['article_id']);
        exit;
    }

    
public function store()
{
    
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error'] = 'Please login to comment';
        header('Location: /blog/public/login');
        exit;
    }
    
   
    $article_id = $_POST['article_id'] ?? null;
    $content = trim($_POST['content'] ?? '');
    
   
    if (empty($article_id)) {
        $_SESSION['error'] = 'Article ID is required';
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/blog/public/'));
        exit;
    }
    
    if (empty($content)) {
        $_SESSION['error'] = 'Comment content is required';
        header('Location: /blog/public/article?id=' . $article_id);
        exit;
    }
    
    
    $article = Article::find($article_id);
    if (!$article) {
        $_SESSION['error'] = 'Article not found';
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/blog/public/'));
        exit;
    }
    
   
    $commentData = [
        'article_id' => $article_id,
        'user_id' => $_SESSION['user_id'],
        'content' => $content
    ];
    
   
    $result = Comment::create($commentData);
    
    if ($result) {
        $_SESSION['success'] = 'Comment added successfully!';
    } else {
        $_SESSION['error'] = 'Failed to add comment. Please try again.';
    }
    
    
    header('Location: /blog/public/article?id=' . $article_id);
    exit;
}
}