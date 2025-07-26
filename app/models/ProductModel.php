<?php

namespace App\Models;

use PDO;

class ProductModel
{
    private PDO $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    // Lấy sản phẩm theo bộ lọc
    public function getProducts($loai = null, $priceRange = null, $sort = 'default')
    {
        $sql = "SELECT id, ten, gia, hinhanh1, loai FROM sanpham";
        $where = [];
        $params = [];

        if ($loai && $loai !== 'all') {
            $where[] = 'loai = ?';
            $params[] = $loai;
        }

        if ($priceRange && $priceRange !== 'all') {
            $parts = explode('-', $priceRange);
            if (isset($parts[1]) && is_numeric($parts[0]) && is_numeric($parts[1])) {
                $where[] = 'gia BETWEEN ? AND ?';
                $params[] = (float)$parts[0];
                $params[] = (float)$parts[1];
            } elseif (is_numeric($parts[0])) {
                $where[] = 'gia >= ?';
                $params[] = (float)$parts[0];
            }
        }

        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        $orderBy = match ($sort) {
            'price_asc' => ' ORDER BY gia ASC',
            'price_desc' => ' ORDER BY gia DESC',
            'name_asc' => ' ORDER BY ten ASC',
            'name_desc' => ' ORDER BY ten DESC',
            default => '',
        };

        $sql .= $orderBy;

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh mục sản phẩm
    public function getCategories(): array
    {
        $stmt = $this->db->query("SELECT DISTINCT loai FROM sanpham ORDER BY loai ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy tất cả thông tin sản phẩm
    public function getAllProductInfo(): array
    {
        $stmt = $this->db->query("SELECT id, ten, hinhanh1, loai, gia FROM sanpham ORDER BY ten");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
