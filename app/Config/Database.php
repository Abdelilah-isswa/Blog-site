<?php

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private $servername = 'localhost';
    private $username = 'root';
    private $password = 'alilah396';
    private $dbname = 'blog_db';

    public function connect()
    {
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $conn;
        } catch (PDOException $e) {
            $controllerClass = "App\\Controllers\\NotFoundController";
            $controller = new $controllerClass();
            $controller->index();
            exit();
        }
    }
    
    
    private static $instance = null;
    
    public static function getInstance()
    {
        if (self::$instance === null) {
            $db = new self();
            self::$instance = $db->connect();
        }
        return self::$instance;
    }
}