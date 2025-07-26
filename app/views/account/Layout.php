<div class="container-fluid">
    <div class="container">
        <div class="row my-3 gap-4 justify-content-center">
            <div class="col-12 col-md-3 border border-secondary rounded-3">
                <div class="d-flex align-items-center justify-content-center mt-3 gap-2">
                    <img src="/Images/Logo/avt.png" alt="avt" class="rounded-circle" width="50" height="50">
                    <div><?php echo htmlspecialchars($fullname); ?></div>
                </div>
                <hr>
                <ul class="list-unstyled">
                    <li><a class="content-animation d-block py-2" href="/pages/account/home"><i class="fas fa-tachometer-alt"></i> Trang chính</a></li>
                    <li><a class="content-animation d-block py-2" href="/pages/account/order"><i class="fas fa-shopping-bag"></i> Đơn hàng</a></li>
                    <li><a class="content-animation d-block py-2" href="/pages/account/like"><i class="fa-solid fa-heart"></i> Sản phẩm yêu thích</a></li>
                    <li><a class="content-animation d-block py-2" href="/pages/account/info"><i class="fas fa-user-circle"></i> Thông tin cá nhân</a></li>
                    <li><a class="content-animation d-block py-2" href="/pages/account/address"><i class="fas fa-map-marker-alt"></i> Địa chỉ</a></li>
                    <li><a class="content-animation d-block py-2" href="/pages/account/changepass"><i class="fas fa-lock"></i> Đổi mật khẩu</a></li>
                </ul>
                <hr>
                <ul class="list-unstyled">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <li>
                            <a class="content-animation d-block py-2" href="/admin/products">
                                <i class="fas fa-tools"></i> Quản lý hệ thống
                            </a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a class="content-animation d-block py-2" href="/pages/account/logout">
                            <i class="fas fa-sign-out-alt"></i> Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Content -->
            <div class="col-12 col-md-8">
                <?php if (isset($content_account)) echo $content_account; ?>
            </div>
        </div>
    </div>
</div>