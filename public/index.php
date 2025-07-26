<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use Bramus\Router\Router;

$router = new Router();

// ROUTE TRANG CHỦ
$router->get('/pages/home', 'App\Controllers\HomeController@index');

// ROUTE SẢN PHẨM
$router->get('/pages/product', 'App\Controllers\ProductController@index');

// ROUTE CHI TIẾT SẢN PHẨM
$router->get('/pages/product/productdetail', 'App\Controllers\ProductDetailController@show');

// ROUTE ĐĂNG KÝ, ĐĂNG NHẬP, ĐĂNG XUẤT
$router->get('/pages/logup', 'App\Controllers\LogupController@register');
$router->post('/pages/logup', 'App\Controllers\LogupController@register');

$router->get('/pages/login', 'App\Controllers\LoginController@showLoginForm');
$router->post('/pages/login', 'App\Controllers\LoginController@login');

$router->get('/pages/logout', 'App\Controllers\LoginController@logout');
$router->get('/pages/account/logout', 'App\Controllers\LoginController@logout');


// ROUTE ACCOUNT CHÍNH
$router->get('/pages/account', 'App\Controllers\AccountController@index');
$router->get('/pages/account/home', 'App\Controllers\AccountController@index');

// ROUTE THÔNG TIN CÁ NHÂN
$router->get('/pages/account/info', 'App\Controllers\AccountController@info');

// ROUTE ĐỊA CHỈ
$router->get('/pages/account/address', 'App\Controllers\AccountController@address');
$router->post('/pages/account/address', 'App\Controllers\UserAddressController@update');

// ROUTE LỊCH SỬ ĐƠN HÀNG
$router->get('/pages/account/order', 'App\Controllers\AccountController@orderHistory');

// ROUTE GIỎ HÀNG
$router->get('/pages/cart', 'App\Controllers\CartController@index');
$router->post('/pages/cart/add', 'App\Controllers\CartController@add');
$router->post('/pages/cart/remove', 'App\Controllers\CartController@remove');
$router->post('/pages/cart/update-quantity', 'App\Controllers\CartController@updateQuantity');
$router->get('/pages/cart/checkout', 'App\Controllers\CartController@checkout');
$router->post('/pages/cart/checkout', 'App\Controllers\CartController@processCheckout');

// ROUTE ADMIN
// ROUTE ADMIN SẢN PHẨM
$router->get('/admin/users', 'App\Controllers\Admin\AdminUserController@index');
$router->get('/admin/products', 'App\Controllers\Admin\AdminProductController@index'); // Danh sách sản phẩm
$router->get('/admin/products/create', 'App\Controllers\Admin\AdminProductController@create'); // Form thêm sản phẩm
$router->post('/admin/products/store', 'App\Controllers\Admin\AdminProductController@store'); // Xử lý thêm sản phẩm
$router->get('/admin/products/edit/(\w+)', 'App\Controllers\Admin\AdminProductController@edit'); // Form sửa sản phẩm
$router->post('/admin/products/update/(\w+)', 'App\Controllers\Admin\AdminProductController@update'); // Xử lý cập nhật sản phẩm
$router->post('/admin/products/delete/(\w+)', 'App\Controllers\Admin\AdminProductController@destroy'); // Xử lý xóa sản phẩm
// ROUTE ADMIN ĐƠN HÀNG
$router->get('/admin/orders', 'App\Controllers\Admin\AdminOrderController@index'); // Danh sách đơn hàng
$router->post('/admin/orders/update_status', 'App\Controllers\Admin\AdminOrderController@updateStatus'); 
// ROUTE 404
$router->set404('\App\Controllers\ErrorController@sendNotFound'); 
// ROUTE LIÊN HỆ
$router->get('/pages/contact', 'App\Controllers\ContactController@index');

$router->run();

