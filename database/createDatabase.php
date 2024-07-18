<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;

$db = Database::getInstance()->getConnection();

$sql = "
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    parent_id INT,
    FOREIGN KEY (parent_id) REFERENCES categories(id)
);

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('income', 'expense') NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    date DATE NOT NULL,
    description TEXT,
    category_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE budgets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);
";

try {
    $db->exec($sql);
    echo "Tables created successfully.";
} catch (PDOException $e) {
    echo "Error creating tables: " . $e->getMessage();
}
