<?php

namespace App\Model;

use App\Config\Database;

class Category {
    public string $name;

    public function save(): bool
    {
        $database = Database::getInstance()->getConnection();
        $query = "INSERT INTO categories (name) VALUES (?)";
        $stmt = $database->prepare($query);

        return $stmt->execute([$this->name]);
    }
}