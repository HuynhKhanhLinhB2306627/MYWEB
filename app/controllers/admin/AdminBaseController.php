<?php
namespace App\Controllers\Admin;

class AdminBaseController
{
    public function __construct()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            redirect('/pages/login');
            exit;
        }
    }

    protected function render(string $view, array $data = [])
    {
        extract($data);
        // Đường dẫn đến file nội dung chính
        $content_view = __DIR__ . "/../../views/admin/{$view}.php";
        
        // Gọi file layout, file layout sẽ tự nạp $content_view
        require_once __DIR__ . '/../../views/admin/layout.php';
    }
}