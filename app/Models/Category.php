<?php
namespace App\Models;

use App\Config\Database;

class Category
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
    
    public static function getAll()
    {
        $conn = self::getConnection();
        $sql = "SELECT * FROM categories ORDER BY categorie_name";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
       public static function findByName($name)
    {
        $conn = self::getConnection();
        $sql = "SELECT * FROM categories WHERE categorie_name = :name";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name' => $name]);
        return $stmt->fetch();
    }
    
    public static function find($id)
    {
        $conn = self::getConnection();
        $sql = "SELECT * FROM categories WHERE categorie_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    public static function getByCreator($creatorId)
    {
        $conn = self::getConnection();
        $sql = "SELECT * FROM categories WHERE creator_id = :creator_id ORDER BY create_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['creator_id' => $creatorId]);
        return $stmt->fetchAll();
    }
    
    public static function count()
    {
        $conn = self::getConnection();
        $sql = "SELECT COUNT(*) as count FROM categories";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['count'];
    }
public static function create($data)
{
    $conn = self::getConnection();
    
    
   
    
    $sql = "INSERT INTO categories (categorie_name, description, creator_id) 
            VALUES (:categorie_name, :description, :creator_id)";
    
   
    
    $stmt = $conn->prepare($sql);
    
    $params = [
        'categorie_name' => $data['categorie_name'],
        'description' => $data['description'] ?? null,
        'creator_id' => $data['creator_id'] ?? null
    ];
    
  
    
        $result = $stmt->execute($params);
        
        return $result;
    
}
        public static function update($id, $data)
    {
        $conn = self::getConnection();
        
        unset($data['id'], $data['categorie_id']);
        
        $setClause = '';
        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, ";
        }
        $setClause = rtrim($setClause, ', ');
        
        $sql = "UPDATE categories SET $setClause WHERE categorie_id = :id";
        $data['id'] = $id;
        
        $stmt = $conn->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        
        return $stmt->execute();
    }



        public static function delete($id)
    {
        $conn = self::getConnection();
        
        
        $category = self::find($id);
        if (!$category) {
            return false;
        }
        
       
        $sql = "SELECT COUNT(*) as count FROM Article WHERE categorie_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        
        if ($result['count'] > 0) {
            return false; 
        }
        
        $sql = "DELETE FROM categories WHERE categorie_id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

        public static function getCategoriesWithCount()
    {
        $conn = self::getConnection();
        $sql = "SELECT 
                    c.*,
                    COUNT(a.article_id) as article_count
                FROM categories c
                LEFT JOIN Article a ON c.categorie_id = a.categorie_id
                GROUP BY c.categorie_id
                ORDER BY c.categorie_name ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


}