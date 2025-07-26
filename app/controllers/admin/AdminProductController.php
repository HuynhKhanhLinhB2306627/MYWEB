<?php

namespace App\Controllers\Admin;

use App\Models\Admin\ProductModel;

class AdminProductController extends AdminBaseController
{
    private ProductModel $productModel;
    // Định nghĩa đường dẫn thư mục upload gốc để dễ quản lý
    private string $uploadBaseDir = __DIR__ . "/../../../public/Images/";

    public function __construct()
    {
        // Khởi tạo AdminProductController
        parent::__construct();
        global $PDO;
        $this->productModel = new ProductModel($PDO);
    }

    public function index()
    {
        // Hiển thị danh sách sản phẩm
        $products = $this->productModel->getAll();
        $this->render('products/index', [
            'products' => $products,
            'success' => session_get_once('success'),
            'errors' => session_get_once('errors')
        ]);
    }

    public function create()
    {
        // Hiển thị form thêm sản phẩm
        $this->render('products/create');
    }

    public function store()
    {
        // Xử lý thêm sản phẩm mới
        if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
            redirect('/admin/products/create', ['errors' => ['Yêu cầu không hợp lệ.']]);
            return;
        }
        $data = $_POST;
        $files = $_FILES;

        // Kiểm tra dữ liệu đầu vào
        $errors = [];
        if (empty($data['ten'])) {
            $errors[] = 'Tên sản phẩm không được để trống.';
        }
        if (empty($data['loai'])) {
            $errors[] = 'Loại sản phẩm không được để trống.';
        }
        if (empty($data['gia']) || !is_numeric($data['gia'])) {
            $errors[] = 'Giá sản phẩm không hợp lệ.';
        }
        if (empty($files['hinhanh1']['name'])) {
            $errors[] = 'Hình ảnh chính là bắt buộc.';
        }

        if (!empty($errors)) {
            redirect('/admin/products/create', ['errors' => $errors]);
            return;
        }
        // Kết thúc kiểm tra dữ liệu

        $image_paths = [];
        $categoryDir = $this->uploadBaseDir . $data['loai'] . "/";

        // Lặp qua các trường ảnh và sử dụng hàm chung
        $image_fields = ['hinhanh1', 'hinhanh2', 'hinhanh3', 'hinhanh4'];
        foreach ($image_fields as $field) {
            $image_paths[$field] = handleUpload($field, $categoryDir);
        }

        // Kiểm tra ảnh chính đã được upload thành công chưa
        if (!$image_paths['hinhanh1']) {
            redirect('/admin/products/create', ['errors' => ['Upload hình ảnh chính thất bại.']]);
            return;
        }

        $product_data = array_merge($data, $image_paths);
        $this->productModel->create($product_data);

        redirect('/admin/products', ['success' => 'Thêm sản phẩm thành công!']);
    }

    public function edit($id)
    {
        // Hiển thị form chỉnh sửa sản phẩm
        $product = $this->productModel->find($id);
        if (!$product) {
            redirect('/admin/products', ['errors' => ['Không tìm thấy sản phẩm.']]);
            return;
        }
        $this->render('products/edit', ['product' => $product]);
    }


    public function update($id)
    {
        // Xử lý cập nhật sản phẩm
        if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
            redirect('/admin/products/edit/' . $id, ['errors' => ['Yêu cầu không hợp lệ.']]);
            return;
        }
        $product = $this->productModel->find($id);
        if (!$product) {
            redirect('/admin/products', ['errors' => ['Sản phẩm không tồn tại.']]);
            return;
        }

        $data = $_POST;
        $files = $_FILES;


        $image_data = [];
        $newCategory = $data['loai'];
        $oldCategory = $product['loai'];
        $newCategoryDir = $this->uploadBaseDir . $newCategory . "/";
        $oldCategoryDir = $this->uploadBaseDir . $oldCategory . "/";

        if ($newCategory !== $oldCategory && !is_dir($newCategoryDir)) {
            mkdir($newCategoryDir, 0777, true);
        }

        $image_fields = ['hinhanh1', 'hinhanh2', 'hinhanh3', 'hinhanh4'];
        foreach ($image_fields as $field) {
            if (isset($files[$field]) && $files[$field]['error'] === UPLOAD_ERR_OK) {
                // Xóa ảnh cũ trước khi upload ảnh mới
                delete_image($product[$field], $oldCategoryDir);
                // Upload ảnh mới
                $image_data[$field] = handleUpload($field, $newCategoryDir);
            } else {
                // Giữ lại ảnh cũ
                $image_data[$field] = $product[$field];
                // Nếu đổi danh mục thì di chuyển ảnh cũ sang thư mục mới
                if ($newCategory !== $oldCategory && $product[$field] && file_exists($oldCategoryDir . $product[$field])) {
                    rename($oldCategoryDir . $product[$field], $newCategoryDir . $product[$field]);
                }
            }
        }

        $product_data = array_merge($data, $image_data);
        $this->productModel->update($id, $product_data);

        redirect('/admin/products', ['success' => 'Cập nhật sản phẩm thành công!']);
    }


    public function destroy($id)
    {
        // Xử lý xóa sản phẩm
        if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
            redirect('/admin/products', ['errors' => ['Yêu cầu không hợp lệ.']]);
            return;
        }
        $product = $this->productModel->find($id);
        if ($product) {
            $categoryDir = $this->uploadBaseDir . $product['loai'] . "/";

            // Xóa tất cả ảnh liên quan
            delete_image($product['hinhanh1'], $categoryDir);
            delete_image($product['hinhanh2'], $categoryDir);
            delete_image($product['hinhanh3'], $categoryDir);
            delete_image($product['hinhanh4'], $categoryDir);

            $this->productModel->delete($id);
            redirect('/admin/products', ['success' => 'Xóa sản phẩm thành công!']);
        } else {
            redirect('/admin/products', ['errors' => ['Sản phẩm không tồn tại.']]);
        }
    }
}
