<?php

namespace App\Controllers;

use App\Models\LogupModel;
use PDOException;

class LogupController
{
    public function register()
    {
        // Nếu không phải là form POST thì chỉ hiển thị view
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            render('auth/logup');
            return;
        }
        if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
            redirect('/pages/logup', ['errors' => ['Yêu cầu không hợp lệ.']]);
            return;
        }

        // Xử lý khi người dùng nhấn nút đăng ký
        global $PDO; // Lấy kết nối DB từ global
        $logupModel = new LogupModel($PDO);
        $errors = [];

        try {
            $fullName = trim($_POST['fullName'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $repeatPassword = $_POST['repeatPassword'] ?? '';
            $phone = trim($_POST['phone'] ?? '');
            $agree = isset($_POST['agree']);

            // Validate
            if (!$fullName) $errors[] = 'Họ tên không được để trống.';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email không hợp lệ.';
            if (strlen($password) < 6) $errors[] = 'Mật khẩu phải có ít nhất 6 ký tự.';
            if ($password !== $repeatPassword) $errors[] = 'Mật khẩu nhập lại không khớp.';
            if (!$agree) $errors[] = 'Bạn phải đồng ý với chính sách của chúng tôi.';

            // Kiểm tra email tồn tại
            if ($logupModel->isEmailExists($email)) {
                $errors[] = 'Email này đã được sử dụng.';
            }

            // Nếu không có lỗi thì tạo tài khoản
            if (empty($errors)) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $logupModel->createUser($fullName, $email, $passwordHash, $phone);
                redirect('/pages/login', ['success' => 'Đăng ký thành công! Vui lòng đăng nhập.']);
                exit;
            }

            // Nếu có lỗi, quay lại trang đăng ký và báo lỗi
            redirect('/pages/logup', ['errors' => $errors]);
        } catch (PDOException $e) {
            redirect('/pages/logup', ['errors' => ['Lỗi hệ thống, vui lòng thử lại sau.']]);
        }
    }
}
