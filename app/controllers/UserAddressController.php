<?php

namespace App\Controllers;

use App\Models\UserAddressModel;
use PDO;
use PDOException;

class UserAddressController
{
    public function update()
    {
        // Kiểm tra phương thức POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra CSRF token
            if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
                redirect('/pages/account/address', ['errors' => ['Yêu cầu không hợp lệ.']]);
                return;
            }
            $detail = trim($_POST['detail'] ?? '');
            $userId = $_SESSION['user_id'] ?? null;

            // Kiểm tra địa chỉ không rỗng
            if (!$detail) {
                $_SESSION['errors'] = ['Không được để trống địa chỉ giao hàng!'];
                header('Location: /pages/account/address');
                exit;
            }

            // Lưu địa chỉ mới cho user
            if ($userId) {
                try {
                    global $PDO;
                    $userModel = new UserAddressModel($PDO);
                    $userModel->saveAddress($userId, $detail);
                    $_SESSION['address'] = $detail;
                    header('Location: /pages/account/info');
                    exit;
                } catch (PDOException $e) {
                    // Lỗi khi lưu địa chỉ
                    $_SESSION['errors'] = ['Lỗi hệ thống: ' . $e->getMessage()];
                    header('Location: /pages/account/address');
                    exit;
                }
            } else {
                // Không tìm thấy user
                header('Location: /pages/login');
                exit;
            }
        } else {
            // Nếu không phải POST thì quay lại trang địa chỉ
            header('Location: /pages/account/address');
            exit;
        }
    }
}
