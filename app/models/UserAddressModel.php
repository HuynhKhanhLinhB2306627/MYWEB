<?php
namespace App\Models;

use PDO;

class UserAddressModel {
    private PDO $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    // Lưu địa chỉ mới cho user
    public function saveAddress($userId, $detail) {
        $sql = 'UPDATE users SET address = ? WHERE id = ?';
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute([$detail, $userId]);
    }
} 