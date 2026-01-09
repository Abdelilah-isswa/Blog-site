<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Like;

class LikeController extends Controller
{
    
    public function toggle()
    {
        
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = 'Please login to like articles';
            header('Location: /blog2/public/login');
            exit;
        }
        
        $article_id = $_POST['article_id'] ?? $_GET['article_id'] ?? '';
        $user_id = $_SESSION['user_id'];
        
        if (empty($article_id) || !is_numeric($article_id)) {
            $_SESSION['error'] = 'Invalid article';
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/blog2/public/'));
            exit;
        }
        
      
        $result = Like::toggle($article_id, $user_id);
        
        if ($result === 'added') {
            $_SESSION['success'] = 'Article liked!';
        } elseif ($result === 'removed') {
            $_SESSION['success'] = 'Like removed';
        } else {
            $_SESSION['error'] = 'Failed to update like';
        }
        
       
        header('Location: /blog2/public/article?id=' . $article_id);
        exit;
    }
}