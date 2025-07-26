<?php

namespace App\Controllers;

use App\Models\ProductModel;
use PDO;

class ProductController
{
    private ProductModel $productModel;

    public function __construct()
    {
        global $PDO;
        $this->productModel = new ProductModel($PDO);
    }

    public function index(): void
    {
        // Lấy tham số lọc và sắp xếp
        $selected_loai = $_GET['loai'] ?? 'all';
        $price_range = $_GET['price'] ?? 'all';
        $sort_option = $_GET['sort'] ?? 'default';

        // Kiểm tra sort hợp lệ
        $allowedSorts = ['default', 'price_asc', 'price_desc', 'name_asc', 'name_desc'];
        if (!in_array($sort_option, $allowedSorts)) {
            $sort_option = 'default';
        }

        // Lấy dữ liệu sản phẩm, danh mục
        $sanphams = $this->productModel->getProducts($selected_loai, $price_range, $sort_option);
        $categories = $this->productModel->getCategories();
        $allProducts = $this->productModel->getAllProductInfo();

        // Xác định text sort
        $sort_text = match ($sort_option) {
            'price_asc' => 'Giá: Tăng dần',
            'price_desc' => 'Giá: Giảm dần',
            'name_asc' => 'Tên: A-Z',
            'name_desc' => 'Tên: Z-A',
            default => 'Mặc định',
        };

        // Render view
        render('product/product', [
            'sanphams' => $sanphams,
            'categories' => $categories,
            'sort_text' => $sort_text,
            'selected_loai' => $selected_loai,
            'price_range' => $price_range,
            'sort_option' => $sort_option,
            'allProducts' => $allProducts,
        ]);
    }
}
