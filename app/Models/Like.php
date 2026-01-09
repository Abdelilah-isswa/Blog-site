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
public static function toggle($articleId, $userId)
{
    if (self::isLiked($userId, $articleId)) {
        return self::remove($articleId, $userId) ? 'removed' : false;
    } else {
        return self::add($articleId, $userId) ? 'added' : false;
    }
}



    private static function getConnection()
    {
        if (self::$conn === null) {
            $database = new Database();
            self::$conn = $database->connect();
        }
        return self::$conn;
    }
    
    public static function countByArticle($articleId)
    {
        $conn = self::getConnection();
        $sql = "SELECT COUNT(*) as count FROM Likes WHERE article_id = :article_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['article_id' => $articleId]);
        $result = $stmt->fetch();
        return $result['count'];
    }
    
    public static function isLiked($userId, $articleId)
    {
        $conn = self::getConnection();
        $sql = "SELECT COUNT(*) as count FROM Likes WHERE user_id = :user_id AND article_id = :article_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'user_id' => $userId,
            'article_id' => $articleId
        ]);
        $result = $stmt->fetch();
        return $result['count'] > 0;
    }
    
    public static function getUserLikes($userId)
    {
        $conn = self::getConnection();
        $sql = "SELECT a.* FROM Article a
                JOIN Likes l ON a.article_id = l.article_id
                WHERE l.user_id = :user_id
                ORDER BY l.like_id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }
    
    public static function countByUser($userId)
    {
        $conn = self::getConnection();
        $sql = "SELECT COUNT(*) as count FROM Likes WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetch();
        return $result['count'];
    }

}