<?php
namespace App\Models;

use App\Config\Database;

class Article
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
    

public static function update($id, $data)
{
    $conn = self::getConnection();
    
    
    unset($data['id'], $data['article_id']);
    
   
    $setClause = '';
    foreach ($data as $key => $value) {
        $setClause .= "$key = :$key, ";
    }
    $setClause = rtrim($setClause, ', ');
    
    $sql = "UPDATE Article SET $setClause WHERE article_id = :id";
    
    
    $data['id'] = $id;
    
    $stmt = $conn->prepare($sql);
    
    
    foreach ($data as $key => $value) {
        $stmt->bindValue(':' . $key, $value);
    }
    
    return $stmt->execute();
}




public static function getAll()
{
    $conn = self::getConnection();
    $sql = "SELECT 
                a.*,
                u.username as author_name,
                c.categorie_name as category_name,
                COUNT(DISTINCT l.like_id) as like_count
            FROM Article a
            LEFT JOIN User u ON a.author_id = u.user_id
            LEFT JOIN categories c ON a.categorie_id = c.categorie_id
            LEFT JOIN Likes l ON a.article_id = l.article_id
            GROUP BY a.article_id
            ORDER BY a.create_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}
public static function find($id)
{
    $conn = self::getConnection();
    $sql = "SELECT 
                a.*,
                u.username as author_name,
                c.categorie_name as category_name,
                COUNT(DISTINCT l.like_id) as like_count
            FROM Article a
            LEFT JOIN User u ON a.author_id = u.user_id
            LEFT JOIN categories c ON a.categorie_id = c.categorie_id
            LEFT JOIN Likes l ON a.article_id = l.article_id
            WHERE a.article_id = :id
            GROUP BY a.article_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}
    
public static function getByCategory($categoryId)
{
    $conn = self::getConnection();
    $sql = "SELECT 
                a.*,
                u.username as author_name,
                c.categorie_name as category_name,
                COUNT(DISTINCT l.like_id) as like_count
            FROM Article a
            LEFT JOIN User u ON a.author_id = u.user_id
            LEFT JOIN categories c ON a.categorie_id = c.categorie_id
            LEFT JOIN Likes l ON a.article_id = l.article_id
            WHERE a.categorie_id = :category_id
            GROUP BY a.article_id
            ORDER BY a.create_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['category_id' => $categoryId]);
    return $stmt->fetchAll();
}
    
    public static function count()
    {
        $conn = self::getConnection();
        $sql = "SELECT COUNT(*) as count FROM Article";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['count'];
    }

    public static function create($data)
{
    $conn = self::getConnection();
    
    
    $data['create_at'] = date('Y-m-d H:i:s');
    
   
    $columns = implode(', ', array_keys($data));
    $placeholders = ':' . implode(', :', array_keys($data));
    
    $sql = "INSERT INTO Article ($columns) VALUES ($placeholders)";
    $stmt = $conn->prepare($sql);
    
   
    foreach ($data as $key => $value) {
        $stmt->bindValue(':' . $key, $value);
    }
    
    return $stmt->execute();
}

public static function delete($id)
{
    $conn = self::getConnection();
    
   
    $article = self::find($id);
    if (!$article) {
        return false;
    }
    
    
    $sql = "DELETE FROM Article WHERE article_id = :id";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute(['id' => $id]);
    

    
    return $result;
}

public static function getByAuthor($authorId)
{
    $conn = self::getConnection();
    $sql = "SELECT 
                a.*,
                u.username as author_name,
                c.categorie_name as category_name,
                COUNT(DISTINCT l.like_id) as like_count
            FROM Article a
            LEFT JOIN User u ON a.author_id = u.user_id
            LEFT JOIN categories c ON a.categorie_id = c.categorie_id
            LEFT JOIN Likes l ON a.article_id = l.article_id
            WHERE a.author_id = :author_id
            GROUP BY a.article_id
            ORDER BY a.create_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['author_id' => $authorId]);
    return $stmt->fetchAll();
}

}