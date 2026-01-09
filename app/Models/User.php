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

}