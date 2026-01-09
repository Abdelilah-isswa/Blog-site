<?php
namespace App\Models;

use App\Config\Database;

class Like
{
private static $conn = null;
public static function add($articleId, $userId)
{
    $conn = self::getConnection();
    
     
    if (self::isLiked($userId, $articleId)) {
        return false; 
    }
    
    $sql = "INSERT INTO Likes (article_id, user_id) VALUES (:article_id, :user_id)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        'article_id' => $articleId,
        'user_id' => $userId
    ]);
}

 
public static function remove($articleId, $userId)
{
    $conn = self::getConnection();
    $sql = "DELETE FROM Likes WHERE article_id = :article_id AND user_id = :user_id";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        'article_id' => $articleId,
        'user_id' => $userId
    ]);
}


}