<?php

namespace App\Controllers;

use App\Models\User;

class LoginController
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        render('auth/login');
    }

    // Xử lý logic đăng nhập
    public function login()
    {
        if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
            redirect('/pages/login', ['errors' => ['Yêu cầu không hợp lệ.']]);
            return;
        }
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = (new User())->findByEmail($email);

        if (!$user) {
            redirect('/pages/login', ['errors' => ['Email hoặc mật khẩu không đúng.']]);
            return;
        }

        // Xác thực mật khẩu và đăng nhập
        if (AUTHGUARD()->login($user, ['password' => $password])) {
            redirect('/pages/account/');
        } else {
            redirect('/pages/login', ['errors' => ['Email hoặc mật khẩu không đúng.']]);
        }
    }

    // Xử lý đăng xuất
    public function logout()
    {
        AUTHGUARD()->logout();
        redirect('/pages/home');
    }
}
