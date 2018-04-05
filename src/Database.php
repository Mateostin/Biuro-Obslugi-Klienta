<?php

class Database
{
    private static $instance;
    private $conn;
    private $DB_HOST = "localhost";
    private $DB_USER = "root";
    private $DB_PASSWORD = "coderslab";
    private $DB_DBNAME = "bok";

    private function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . $this->DB_HOST . ";dbname=" . $this->DB_DBNAME . ";charset=utf8mb4", $this->DB_USER, $this->DB_PASSWORD);
        } catch (PDOException $ex) {
            echo "Błąd połączenia: " . $ex->getMessage();
        }
    }

    private function __clone()
    {
        // EMPTY FUNCTION FOR DISABLE CLONING CONNECTION
    }

    public static function getInstance()
    {
        if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}