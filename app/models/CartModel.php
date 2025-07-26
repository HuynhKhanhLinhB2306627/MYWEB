<?php

namespace App\Models;

use PDO;

class CartModel
{
    private $db;
    public function __construct(PDO $connection)
    {
        $this->db = $connection;
    }
    public function addToCart($user_id, $product_id, $quantity, $price)
    {
        // Nếu đã có sản phẩm thì tăng số lượng
        $stmt = $this->db->prepare('SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?');
        $stmt->execute([$user_id, $product_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $new_quantity = $row['quantity'] + $quantity;
            $update = $this->db->prepare('UPDATE cart SET quantity = ? WHERE id = ?');
            $update->execute([$new_quantity, $row['id']]);
        } else {
            $insert = $this->db->prepare('INSERT INTO cart (user_id, product_id, quantity, price) VALUES (?, ?, ?, ?)');
            $insert->execute([$user_id, $product_id, $quantity, $price]);
        }
    }

    public function getCartByUser($user_id)
    {
        $stmt = $this->db->prepare('SELECT c.*, s.ten, s.hinhanh1, s.loai FROM cart c JOIN sanpham s ON c.product_id = s.id WHERE c.user_id = ?');
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeFromCart($user_id, $product_id)
    {
        $stmt = $this->db->prepare('DELETE FROM cart WHERE user_id = ? AND product_id = ?');
        $stmt->execute([$user_id, $product_id]);
    }
    
    public function updateQuantity($user_id, $product_id, $quantity)
    {
        $stmt = $this->db->prepare('UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?');
        $stmt->execute([$quantity, $user_id, $product_id]);
    }
}
