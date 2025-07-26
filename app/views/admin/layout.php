<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-lg-2 d-none d-lg-block bg-dark text-white min-vh-100 p-3">
            <div class="d-flex flex-column flex-shrink-0 h-100">
                <a href="/admin/products" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <i class="fa fa-cogs fa-2x me-2"></i>
                    <span class="fs-4">Admin Panel</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="/admin/products" class="nav-link text-white <?= (strpos($_SERVER['REQUEST_URI'], '/admin/products') !== false) ? 'active' : '' ?>">
                            <i class="fa fa-box me-2"></i> Quản lý Sản phẩm
                        </a>
                    </li>
                    <li>
                        <a href="/admin/orders" class="nav-link text-white <?= (strpos($_SERVER['REQUEST_URI'], '/admin/orders') !== false) ? 'active' : '' ?>">
                            <i class="fa fa-file-invoice-dollar me-2"></i> Quản lý Đơn hàng
                        </a>
                    </li>
                    <li>
                        <a href="/admin/users" class="nav-link text-white <?= (strpos($_SERVER['REQUEST_URI'], '/admin/users') !== false) ? 'active' : '' ?>">
                            <i class="fa fa-users me-2"></i> Quản lý Người dùng
                        </a>
                    </li>
                    </ul>
                <hr>
                <ul class="nav nav-pills flex-column">
                    <li>
                        <a href="/pages/home" class="nav-link text-white">
                            <i class="fa fa-home me-2"></i> Về trang chủ
                        </a>
                    </li>
                    <li>
                        <a href="/pages/logout" class="nav-link text-white">
                            <i class="fa fa-sign-out-alt me-2"></i> Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-lg-10 p-0">
            <nav class="navbar navbar-light bg-light d-lg-none sticky-top">
                <div class="container-fluid">
                    <button class="btn btn-outline-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAdminSidebar" aria-controls="offcanvasAdminSidebar">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a href="/admin/products" class="navbar-brand mb-0 h1">Admin Panel</a>
                    <a href="/pages/home" class="btn btn-sm btn-outline-secondary">
                       <i class="fa fa-home"></i>
                    </a>
                </div>
            </nav>

            <div class="p-4">
                <?php require_once $content_view; ?>
            </div>
        </main>
    </div>
</div>

<div class="offcanvas offcanvas-start d-lg-none text-white bg-dark" tabindex="-1" id="offcanvasAdminSidebar" aria-labelledby="offcanvasAdminSidebarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasAdminSidebarLabel">
        <a href="/admin/products" class="d-flex align-items-center text-white text-decoration-none">
            <i class="fa fa-cogs fa-2x me-2"></i>
            <span class="fs-4">Admin Panel</span>
        </a>
    </h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column p-3">
        <hr class="mt-0">
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="/admin/products" class="nav-link text-white <?= (strpos($_SERVER['REQUEST_URI'], '/admin/products') !== false) ? 'active' : '' ?>">
                    <i class="fa fa-box me-2"></i> Quản lý Sản phẩm
                </a>
            </li>
            <li>
                <a href="/admin/orders" class="nav-link text-white <?= (strpos($_SERVER['REQUEST_URI'], '/admin/orders') !== false) ? 'active' : '' ?>">
                    <i class="fa fa-file-invoice-dollar me-2"></i> Quản lý Đơn hàng
                </a>
            </li>
            <li>
                <a href="/admin/users" class="nav-link text-white <?= (strpos($_SERVER['REQUEST_URI'], '/admin/users') !== false) ? 'active' : '' ?>">
                    <i class="fa fa-users me-2"></i> Quản lý Người dùng
                </a>
            </li>
            </ul>
        <hr>
        <ul class="nav nav-pills flex-column">
            <li>
                <a href="/pages/home" class="nav-link text-white">
                    <i class="fa fa-home me-2"></i> Về trang chủ
                </a>
            </li>
            <li>
                <a href="/pages/logout" class="nav-link text-white">
                    <i class="fa fa-sign-out-alt me-2"></i> Đăng xuất
                </a>
            </li>
        </ul>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>