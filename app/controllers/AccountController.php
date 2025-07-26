<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\OrderModel;

class AccountController
{
    private ?User $user;

    public function __construct()
    {
        // Kiểm tra đăng nhập 
        if (!AUTHGUARD()->isUserLoggedIn()) {
            redirect('/pages/login');
            exit;
        }
        $this->user = AUTHGUARD()->user();
    }

    public function index()
    {
        // Hiển thị trang chính tài khoản
        global $PDO;
        $orderModel = new OrderModel($PDO);
        $recentOrders = $orderModel->getRecentOrdersByUser($this->user->id, 3);
        $order_items = $orderModel->getOrderItemsForOrders($recentOrders);

        $this->renderView('User_Home', [
            'recentOrders' => $recentOrders,
            'order_items' => $order_items,
        ]);
    }

    public function info()
    {
        // Hiển thị trang thông tin cá nhân
        $this->renderView('User_Info');
    }

    public function address()
    {
        // Hiển thị trang địa chỉ
        $this->renderView('User_Address');
    }

    public function orderHistory()
    {
        // Hiển thị lịch sử đơn hàng
        global $PDO;
        $orderModel = new OrderModel($PDO);
    
        $orders = $orderModel->getOrdersByUser($this->user->id);
        $order_items = $orderModel->getOrderItemsForOrders($orders);
    
        $this->renderView('Order_History', [
            'orders' => $orders,
            'order_items' => $order_items,
        ]);
    }
    

    private function renderView(string $viewName, array $data = [])
    {
        // Render layout tài khoản
        // Lấy thông tin user
        $fullname = $this->user->full_name;
        $email = $this->user->email;
        $phone = $this->user->phone;
        $address = $this->user->address;
        $role = $this->user->role;
    
        // Truyen du lieu vao view
        extract($data);
    
        // Render view con
        ob_start();
        require __DIR__ . "/../views/account/{$viewName}.php";
        $content_account = ob_get_clean();
    
        // Render layout con
        ob_start();
        require __DIR__ . '/../views/account/Layout.php';
        $content = ob_get_clean();
    
        // Render layout tổng
        require __DIR__ . '/../views/layout.php';
    }
}