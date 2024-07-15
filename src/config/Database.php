<?php
namespace App\Config;

use PDO;
use PDOException;

class Database {
    private static ?Database $instance = null;
    private PDO $db;

    private function __construct() {
        $config = Config::getInstance();
        $host = $config->get('DB_HOST');
        $db_name = $config->get('DB_NAME');
        $username = $config->get('DB_USER');
        $password = $config->get('DB_PASS');
        $port = $config->get('DB_PORT');

        try {
            $this->db = new PDO('mysql:host=' . $host . '; port=' . $port . ';dbname=' . $db_name, $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance(): ?Database
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->db;
    }
}