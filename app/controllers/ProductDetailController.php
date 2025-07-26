<?php

namespace App\Controllers;

use App\Models\ProductDetailModel;
use PDO;

class ProductDetailController
{
    private ProductDetailModel $productModel;

    public function __construct()
    {
        global $PDO;
        $this->productModel = new ProductDetailModel($PDO);
    }

    public function show(): void
    {
        $product_id = $_GET['id'] ?? null;

        if (!$product_id) {
            http_response_code(400);
            die('Lỗi: ID không hợp lệ.');
        }


        $product = $this->productModel->getProductById($product_id);
        if (!$product) {
            http_response_code(404);
            die('Sản phẩm không tồn tại!');
        }

        // Khởi tạo session nếu chưa có
        if (!isset($_SESSION['viewed_products'])) {
            $_SESSION['viewed_products'] = [];
        }

        // Xóa ID sản phẩm nếu nó đã tồn tại trong danh sách để đưa lên đầu
        $key = array_search($product_id, $_SESSION['viewed_products']);
        if ($key !== false) {
            unset($_SESSION['viewed_products'][$key]);
        }

        // Luôn thêm ID sản phẩm mới nhất vào đầu mảng
        array_unshift($_SESSION['viewed_products'], $product_id);

        // Giới hạn danh sách chỉ 10 sản phẩm
        $_SESSION['viewed_products'] = array_slice($_SESSION['viewed_products'], 0, 10);

        $related_products = $this->productModel->getRelatedProducts($product['loai'], $product_id);
        $allProducts = $this->productModel->getAllProductInfo();


        render('product/productdetail', [
            'product_id' => $product_id,
            'product' => $product,
            'related_products' => $related_products,
            'key' => $key,
            'viewed_products' => $_SESSION['viewed_products'],
            'allProducts'=>$allProducts
        ]);
        
    }
}
