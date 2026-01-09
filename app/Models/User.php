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
    



}