<?php
namespace EcommerceGroup10\Cakery\Helpers;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $conn;
    private static $config;

    private function __construct()
    {
        try {
            $dsn = "mysql:host=" . self::$config['host'] . 
                   ";dbname=" . self::$config['dbname'] . 
                   ";charset=" . self::$config['charset'];
            
            $this->conn = new PDO($dsn, self::$config['username'], self::$config['password']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function init($config)
    {
        self::$config = $config;
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
