<?php
namespace App\Models;

use App\Config\Database;

class Comment
{
    private static $conn = null;
    
    private static function getConnection()
    {
        if (self::$conn === null) {
            $database = new Database();
            self::$conn = $database->connect();
        }
        return self::$conn;
    }
    
    public static function find($id)
    {
        $conn = self::getConnection();
        $sql = "SELECT c.*, u.username as author_name 
                FROM comments c 
                LEFT JOIN User u ON c.user_id = u.user_id 
                WHERE c.comment_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
public static function getByArticle($articleId)
{
    $conn = self::getConnection();
    $sql = "SELECT c.*, u.username as author_name 
            FROM comments c 
            LEFT JOIN User u ON c.user_id = u.user_id 
            WHERE c.article_id = :article_id 
            ORDER BY c.comment_id DESC";  
    $stmt = $conn->prepare($sql);
    $stmt->execute(['article_id' => $articleId]);
    return $stmt->fetchAll();
}
    
    public static function create($data)
    {
        $conn = self::getConnection();
         $sql = "INSERT INTO comments (article_id, user_id, content) 
            VALUES (:article_id, :user_id, :content)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'article_id' => $data['article_id'],
            'user_id' => $data['user_id'],
            'content' => $data['content']
        ]);
    }
    
    public static function update($id, $content)
    {
        $conn = self::getConnection();
        $sql = "UPDATE comments SET content = :content WHERE comment_id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'content' => $content
        ]);
    }
    
    public static function delete($id)
    {
        $conn = self::getConnection();
        $sql = "DELETE FROM comments WHERE comment_id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
    
    public static function countByArticle($articleId)
    {
        $conn = self::getConnection();
        $sql = "SELECT COUNT(*) as count FROM comments WHERE article_id = :article_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['article_id' => $articleId]);
        $result = $stmt->fetch();
        return $result['count'];
    }
    
    public static function isOwner($commentId, $userId)
    {
        $conn = self::getConnection();
        $sql = "SELECT COUNT(*) as count FROM comments 
                WHERE comment_id = :comment_id AND user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'comment_id' => $commentId,
            'user_id' => $userId
        ]);
        $result = $stmt->fetch();
        return $result['count'] > 0;
    }
}