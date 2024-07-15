<?php
namespace App\Models;

use App\Config\Database;

class User {
    private \PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create(array $data): bool {
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        return $stmt->execute();
    }
}