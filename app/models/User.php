<?php
namespace App\Models;

use PDO;

class User
{
    protected ?PDO $connection;
    public ?int $id = null;
    public ?string $full_name = null;
    public ?string $email = null;
    public ?string $phone = null;
    public ?string $password_hash = null;
    public ?string $role = null;
    public ?string $address = null; // Địa chỉ

    public function __construct()
    {
        global $PDO;
        $this->connection = $PDO;
    }

    // Tìm user theo email
    public function findByEmail(string $email): ?self
    {
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return $this->populate($data);
    }
    
    // Tìm user theo ID
    public function findById(int $id): ?self
    {
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }
        
        return $this->populate($data);
    }
    
    // Gán dữ liệu vào thuộc tính User
    private function populate(array $data): self
    {
        $this->id = $data['id'];
        $this->full_name = $data['full_name'];
        $this->email = $data['email'];
        $this->phone = $data['phone'];
        $this->password_hash = $data['password_hash'];
        $this->role = $data['role'];
        $this->address = $data['address']; // Địa chỉ

        return $this;
    }
    // Lấy tất cả user
    public function getAll(): array
    {
        $stmt = $this->connection->query("SELECT * FROM users ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}