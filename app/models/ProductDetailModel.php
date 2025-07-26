<?php

namespace App\Models;

use PDO;

class ProductDetailModel
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    // Lấy chi tiết sản phẩm theo ID
    public function getProductById($id): ?array
    {
        $stmt = $this->connection->prepare("SELECT * FROM sanpham WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Lấy sản phẩm liên quan
    public function getRelatedProducts($loai, $id): array
    {
        $stmt = $this->connection->prepare("SELECT id, ten, gia, hinhanh1 FROM sanpham WHERE loai = ? AND id != ? LIMIT 5");
        $stmt->execute([$loai, $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Lấy tất cả thông tin sản phẩm
    public function getAllProductInfo(): array
    {
        $stmt = $this->connection->query("SELECT id, ten, hinhanh1, loai, gia FROM sanpham ORDER BY ten");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
