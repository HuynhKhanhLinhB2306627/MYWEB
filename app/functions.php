<?php
function html_escape(string|null $text): string
{
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8', false);
}

function handleUpload(string $file_key, string $upload_dir): ?string
{
    if (isset($_FILES[$file_key]) && $_FILES[$file_key]['error'] === UPLOAD_ERR_OK) {
        $tmp = $_FILES[$file_key]['tmp_name'];
        $name = uniqid() . '_' . basename($_FILES[$file_key]['name']);
        $target = rtrim($upload_dir, '/\\') . DIRECTORY_SEPARATOR . $name;

        if (move_uploaded_file($tmp, $target)) {
            return $name;
        } else {
            error_log(" Lỗi không move được ảnh: $tmp -> $target");
        }
    }
    return null;
}

function delete_image(?string $filename, string $directory): void
{
    if ($filename) {
        $file_path = rtrim($directory, '/\\') . DIRECTORY_SEPARATOR . $filename;
        if (is_file($file_path)) {
            unlink($file_path);
        }
    }
}


if (!function_exists('PDO')) {
  function PDO(): PDO
  {
    global $PDO;
    return $PDO;
  }
}

if (!function_exists('AUTHGUARD')) {
  function AUTHGUARD(): App\SessionGuard
  {
    global $AUTHGUARD;
    return $AUTHGUARD;
  }
}

if (!function_exists('dd')) {
  function dd($var)
  {
    var_dump($var);
    exit();
  }
}

if (!function_exists('redirect')) {
  // Chuyển hướng đến một trang khác
  function redirect($location, array $data = [])
  {
    foreach ($data as $key => $value) {
      $_SESSION[$key] = $value;
    }

    header('Location: ' . $location, true, 302);
    exit();
  }
}

if (!function_exists('session_get_once')) {
  // Đọc và xóa một biến trong $_SESSION
  function session_get_once($name, $default = null)
  {
    $value = $default;
    if (isset($_SESSION[$name])) {
      $value = $_SESSION[$name];
      unset($_SESSION[$name]);
    }
    return $value;
  }
}

// Thêm vào cuối tệp app/functions.php

if (!function_exists('csrf_token')) {
    // Tạo và lưu trữ một token chống CSRF trong session
    function csrf_token() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}

if (!function_exists('verify_csrf_token')) {
    // Xác minh token được gửi từ form
    function verify_csrf_token($token) {
        if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
            return true;
        }
        return false;
    }
}

function render($viewPath, $data = [])
{
    extract($data);
    ob_start();
    require __DIR__ . "/views/$viewPath.php";
    $content = ob_get_clean();
    require __DIR__ . '/views/layout.php';
}
