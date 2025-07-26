<?php

namespace App\Controllers;

use App\Models\ProductHomeModel;

class HomeController
{
    private $productHomeModel;

    public function __construct()
    {
        global $PDO;
        $this->productHomeModel = new ProductHomeModel($PDO);
    }

    public function index()
    {
        // Sản phẩm mới
        $newProducts = $this->productHomeModel->getNewProducts();

        $recentlyViewed = $this->productHomeModel->recentlyViewed();

        $allProducts = $this->productHomeModel->getAllProductInfo();

        render('home/home', [
            'newProducts' => $newProducts,
            'recentlyViewed' => $recentlyViewed,
            'allProducts' => $allProducts,
        ]);
    }
}
