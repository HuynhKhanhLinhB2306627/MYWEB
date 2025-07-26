<?php

namespace App\Models;

use PDO;

class ProductHomeModel
{
    private $db;
    public function __construct(PDO $connection)
    {
        $this->db = $connection;
    }
    // Lấy sản phẩm mới theo từng loại
    public function getNewProducts($limitPerCategory = 5)
    {
        $sql = "
            SELECT id, ten, gia, hinhanh1, loai FROM (
                SELECT id, ten, gia, hinhanh1, loai,
                       ROW_NUMBER() OVER(PARTITION BY loai ORDER BY id DESC) as rn
                FROM sanpham
            ) AS ranked_products
            WHERE rn <= ?
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$limitPerCategory]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Lấy sản phẩm đã xem gần đây
    public function recentlyViewed(): array
    {

        if (empty($_SESSION['viewed_products'])) {
            return [];
        }

        $viewed_ids = $_SESSION['viewed_products'];

        $in_placeholders = implode(',', array_fill(0, count($viewed_ids), '?'));

        $case_sql = "CASE id ";
        foreach ($viewed_ids as $index => $id) {
            $case_sql .= "WHEN ? THEN " . ($index + 1) . " ";
        }
        $case_sql .= "END";


        $sql = "SELECT id, ten, gia, hinhanh1, loai 
            FROM sanpham 
            WHERE id IN ($in_placeholders) 
            ORDER BY $case_sql";

        $params = array_merge($viewed_ids, $viewed_ids);

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Lấy tất cả thông tin sản phẩm
    public function getAllProductInfo(): array
    {
        $stmt = $this->db->query("SELECT id, ten, hinhanh1, loai, gia FROM sanpham ORDER BY ten");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
