<?php

namespace App\Models;

use PDO;

class LogupModel
{
    protected PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    // Kiểm tra email đã tồn tại
    public function isEmailExists($email): bool
    {
        $stmt = $this->connection->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch() ? true : false;
    }

    // Tạo user mới
    public function createUser($fullName, $email, $passwordHash, $phone): void
    {
        $sql = 'INSERT INTO users (full_name, email, password_hash, phone) VALUES (?, ?, ?, ?)';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$fullName, $email, $passwordHash, $phone]);
    }
}
