<?php

namespace App\Models;

use PDO;

class OrderModel
{
    private $db;
    public function __construct(PDO $connection)
    {
        $this->db = $connection;
    }

    // Lấy đơn hàng theo user
    public function getOrdersByUser($user_id)
    {
        $stmt = $this->db->prepare('SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC');
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy chi tiết đơn hàng cho nhiều đơn
    public function getOrderItemsForOrders($orders)
    {
        $order_items = [];
        foreach ($orders as $order) {
            $stmt = $this->db->prepare('SELECT oi.*, s.ten FROM order_items oi JOIN sanpham s ON oi.product_id = s.id WHERE oi.order_id = ?');
            $stmt->execute([$order['id']]);
            $order_items[$order['id']] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $order_items;
    }
    // Lấy tất cả đơn hàng
    public function getAllOrders()
    {
        $stmt = $this->db->prepare(
            'SELECT o.*, u.full_name, u.address, u.phone 
         FROM orders o 
         JOIN users u ON o.user_id = u.id 
         ORDER BY o.created_at DESC'
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Cập nhật trạng thái đơn hàng
    public function updateStatus($order_id, $status)
    {
        $stmt = $this->db->prepare('UPDATE orders SET status = ? WHERE id = ?');
        return $stmt->execute([$status, $order_id]);
    }
    // Lấy đơn hàng gần nhất theo user
    public function getRecentOrdersByUser($userId, $limit = 3)
    {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC LIMIT ?");
        $stmt->execute([$userId, $limit]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
