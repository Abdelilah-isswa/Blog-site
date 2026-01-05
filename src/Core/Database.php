<?php
namespace Core;

class Database {
    private static $instance = null;
    private $pdo;
    
    private function __construct() {
        // Load database configuration
        $config = require APP . '/config/database.php';
        
        try {
            $this->pdo = new \PDO(
                "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']}",
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (\PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    
    public static function getConnection() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }
}
?>