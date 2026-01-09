<?php

namespace App\Models;

use App\Config\Database;

class User
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
        $sql = "SELECT * FROM User WHERE user_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    public static function findByEmail($email)
    {
        $conn = self::getConnection();
        $sql = "SELECT * FROM User WHERE email = :email LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }
    
    public static function findByUsername($username)
    {
        $conn = self::getConnection();
        $sql = "SELECT * FROM User WHERE username = :username LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }
    

    public static function create($data)
    {
        $conn = self::getConnection();
        
        
        if (isset($data['password'])) {
            $data['user_password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['password']);
        }
        
       
        if (!isset($data['user_role'])) {
            $data['user_role'] = 'Reader';
        }
        
       
        $data['create_at'] = date('Y-m-d H:i:s');
         
  
    
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO User ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($sql);
        
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        
        return $stmt->execute();
    }


        public static function update($id, $data)
    {
        $conn = self::getConnection();
        
       
        if (isset($data['password'])) {
            $data['user_password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['password']);
        }
        
      
        $setClause = '';
        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, ";
        }
        $setClause = rtrim($setClause, ', ');
        
        $sql = "UPDATE User SET $setClause WHERE user_id = :id";
        $stmt = $conn->prepare($sql);
        
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->bindValue(':id', $id);
        
        return $stmt->execute();
    }
    public static function delete($id)
    {
        $conn = self::getConnection();
        $sql = "DELETE FROM User WHERE user_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount();
    }
    
    public static function getAll()
    {
        $conn = self::getConnection();
        $sql = "SELECT * FROM User ORDER BY create_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public static function count()
    {
        $conn = self::getConnection();
        $sql = "SELECT COUNT(*) as count FROM User";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['count'];
    }
    
    public static function verifyPassword($inputPassword, $hashedPassword)
    {
        return password_verify($inputPassword, $hashedPassword);
    }

}