<?php
namespace App\Controllers\Admin;

use App\Models\OrderModel;

class AdminOrderController extends AdminBaseController
{
    private OrderModel $orderModel;

    public function __construct()
    {
        // Khởi tạo AdminOrderController
        parent::__construct();
        global $PDO;
        $this->orderModel = new OrderModel($PDO);
    }

    public function index()
    {
        // Hiển thị danh sách đơn hàng
        $orders = $this->orderModel->getAllOrders();
        $order_items = $this->orderModel->getOrderItemsForOrders($orders);

        $this->render('orders/index', [
            'orders' => $orders,
            'order_items' => $order_items,
            'success' => session_get_once('success'),
            'errors' => session_get_once('errors')
        ]);
    }
     public function updateStatus()
    {
        // Cập nhật trạng thái đơn hàng
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_id = $_POST['order_id'] ?? null;
            $status = $_POST['status'] ?? null;

            if ($order_id && $status) {
                if ($this->orderModel->updateStatus($order_id, $status)) {
                    $_SESSION['success'] = 'Cập nhật trạng thái đơn hàng thành công!';
                } else {
                    $_SESSION['errors'] = 'Cập nhật trạng thái thất bại.';
                }
            } else {
                $_SESSION['errors'] = 'Dữ liệu không hợp lệ.';
            }
        }
        redirect('/admin/orders');
    }
}