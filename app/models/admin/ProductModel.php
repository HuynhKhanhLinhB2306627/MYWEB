<?php
namespace App\Models\Admin;

use PDO;

class ProductModel
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    // Lấy tất cả sản phẩm
    public function getAll(): array
    {
        $stmt = $this->connection->query("SELECT * FROM sanpham ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm sản phẩm theo ID
    public function find(string $id): ?array
    {
        $stmt = $this->connection->prepare("SELECT * FROM sanpham WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    // Tạo sản phẩm mới
    public function create(array $data): bool
    {
        // Tạo ID tự động
        $prefix = strtoupper(substr($data['loai'], 0, 2));
        $unique_part = substr(uniqid(), -5);
        $id = $prefix . $unique_part;

        $sql = "INSERT INTO sanpham (id, ten, loai, gia, mota, hinhanh1, hinhanh2, hinhanh3, hinhanh4) 
                VALUES (:id, :ten, :loai, :gia, :mota, :hinhanh1, :hinhanh2, :hinhanh3, :hinhanh4)";
                
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':ten' => $data['ten'],
            ':loai' => $data['loai'],
            ':gia' => $data['gia'],
            ':mota' => $data['mota'] ?? null,
            ':hinhanh1' => $data['hinhanh1'],
            ':hinhanh2' => $data['hinhanh2'] ?? null,
            ':hinhanh3' => $data['hinhanh3'] ?? null,
            ':hinhanh4' => $data['hinhanh4'] ?? null
        ]);
    }

    // Cập nhật sản phẩm
    public function update(string $id, array $data): bool
    {
        $sql = "UPDATE sanpham SET 
                    ten = :ten, 
                    loai = :loai, 
                    gia = :gia, 
                    mota = :mota, 
                    hinhanh1 = :hinhanh1, 
                    hinhanh2 = :hinhanh2, 
                    hinhanh3 = :hinhanh3, 
                    hinhanh4 = :hinhanh4
                WHERE id = :id";
                
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':ten' => $data['ten'],
            ':loai' => $data['loai'],
            ':gia' => $data['gia'],
            ':mota' => $data['mota'],
            ':hinhanh1' => $data['hinhanh1'],
            ':hinhanh2' => $data['hinhanh2'],
            ':hinhanh3' => $data['hinhanh3'],
            ':hinhanh4' => $data['hinhanh4']
        ]);
    }

    public function delete(string $id): bool
    {
        $stmt = $this->connection->prepare("DELETE FROM sanpham WHERE id = ?");
        return $stmt->execute([$id]);
    }
}