<?php

namespace App\Controllers;

use App\Models\CartModel;

class CartController
{
    private CartModel $cartModel;

    public function __construct()
    {
        global $PDO;
        $this->cartModel = new CartModel($PDO);
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add()
    {
        if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
            http_response_code(403);
            echo 'Invalid CSRF token';
            return;
        }
        if (!AUTHGUARD()->isUserLoggedIn()) {
            redirect('/pages/login');
        }
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'] ?? null;
        $quantity = max(1, (int)($_POST['quantity'] ?? 1));
        $price = (int)($_POST['price'] ?? 0);
        if (!$product_id || $price <= 0) {
            http_response_code(400);
            echo 'Dữ liệu không hợp lệ';
            return;
        }
        $this->cartModel->addToCart($user_id, $product_id, $quantity, $price);
        redirect('/pages/cart');
    }

    // Xem giỏ hàng
    public function index()
    {
        if (!AUTHGUARD()->isUserLoggedIn()) {
            redirect('/pages/login');
        }
        $user_id = $_SESSION['user_id'];
        $cart_items = $this->cartModel->getCartByUser($user_id);
        render('account/User_Order', [
            'user_id' => $user_id,
            'cart_items' => $cart_items,
        ]);
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove()
    {
        if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
            redirect('/pages/cart', ['errors' => ['Yêu cầu không hợp lệ.']]);
            return;
        }
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'] ?? null;
        if ($product_id) {
            $this->cartModel->removeFromCart($user_id, $product_id);
        }
        redirect('/pages/cart');
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng (AJAX)
    public function updateQuantity()
    {
        header('Content-Type: application/json');
        if (ob_get_length()) ob_clean();
        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'] ?? null;
        $quantity = max(1, (int)($_POST['quantity'] ?? 1));
        if (!$product_id) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Thiếu dữ liệu']);
            return;
        }
        $this->cartModel->updateQuantity($user_id, $product_id, $quantity);
        // Tính lại tổng tiền
        $cart_items = $this->cartModel->getCartByUser($user_id);
        $subtotal = 0;
        foreach ($cart_items as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $shipping = $subtotal > 0 ? 30000 : 0;
        $total = $subtotal + $shipping;
        echo json_encode([
            'success' => true,
            'subtotal' => number_format($subtotal),
            'shipping' => number_format($shipping),
            'total' => number_format($total)
        ]);
    }

    public function checkout()
    {
        $user = AUTHGUARD()->user();
        if (empty($user->address)) {
            // Chưa có địa chỉ, chuyển sang trang cập nhật địa chỉ
            redirect('/pages/account/address');
        }
        $user_id = $user->id;
        $cart_items = $this->cartModel->getCartByUser($user_id);
        if (empty($cart_items)) {
            redirect('/pages/cart');
        }
        // Tính tổng tiền
        $subtotal = 0;
        foreach ($cart_items as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $shipping = $subtotal > 0 ? 30000 : 0;
        $total = $subtotal + $shipping;

        render('account/Cart_Checkout', [
            'user' => $user,
            'user_id' => $user_id,
            'cart_items' => $cart_items,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
        ]);
    }

    public function processCheckout()
    {
        if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
            redirect('/pages/cart/checkout', ['errors' => ['Yêu cầu không hợp lệ.']]);
            return;
        }
        $user = AUTHGUARD()->user();
        if (empty($user->address)) {
            redirect('/pages/account/address');
        }
        $user_id = $user->id;
        $cart_items = $this->cartModel->getCartByUser($user_id);
        if (empty($cart_items)) {
            redirect('/pages/cart');
        }
        // Tính tổng tiền
        $subtotal = 0;
        foreach ($cart_items as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $shipping = $subtotal > 0 ? 30000 : 0;
        $total = $subtotal + $shipping;

        // Tạo đơn hàng
        $order_code = 'OD' . time() . rand(100, 999);
        global $PDO;
        $stmt = $PDO->prepare('INSERT INTO orders (user_id, order_code, total_price) VALUES (?, ?, ?)');
        $stmt->execute([$user_id, $order_code, $total]);
        $order_id = $PDO->lastInsertId();

        // Thêm chi tiết đơn hàng
        foreach ($cart_items as $item) {
            $stmt = $PDO->prepare('INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)');
            $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
        }

        // Xóa giỏ hàng
        $stmt = $PDO->prepare('DELETE FROM cart WHERE user_id = ?');
        $stmt->execute([$user_id]);

        // Hiện trang xác nhận thành công
        render('account/Cart_Success', [
            'user_id' => $user_id,
            'cart_items' => $cart_items,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
            'order_code' => $order_code,
            'order_id' => $order_id,
        ]);
    }
}
