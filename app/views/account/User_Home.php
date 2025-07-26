<div class="row border border-secondary rounded-3">
    <div class="d-flex align-items-center text-white background rounded-top-3">
        <img src="/Images/Logo/avt.png" alt="avt" class="rounded-circle me-3" width="60">
        <div class="my-2">
            <h5>Xin chào, <?php echo htmlspecialchars($fullname); ?>!</h5>
            <p>Chào mừng bạn đến với trang quản lý tài khoản</p>
        </div>
    </div>
    <div class="d-flex justify-content-around text-center mt-3">
        <div>
            <button class="btn">
                <a href="/pages/cart" class="btn fw-bold text-danger">
                    <i class="fas fa-shopping-bag fa-2x"></i>
                </a>
            </button>
            <p>Giỏ hàng<br><?php ?></p>
        </div>
        <div>
            <i class="fas fa-tag fa-2x text-danger"></i>
            <p>Giảm giá<br>Không có</p>
        </div>
    </div>
</div>

<div class="row border border-secondary rounded-3 mt-3 text-center py-4">
    <h5>Đơn hàng gần đây</h5>
    <?php if (empty($recentOrders)): ?>
        <p class="text-muted">Bạn chưa có đơn hàng nào</p>
        <button class="btn btn-danger w-25 mx-auto">
            <a href="/pages/product" class="btn fw-bold text-light">Mua sắm ngay</a>
        </button>
    <?php else: ?>
        <?php foreach ($recentOrders as $order): ?>
            <div class="row">
                <hr class="">
                <div class="row mt-2">
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-start">
                                <strong>Mã đơn:</strong> <?= htmlspecialchars($order['order_code']) ?>&nbsp;
                                <span class="badge bg-primary rounded-3">
                                    <?= number_format($order['total_price']) ?>₫
                                </span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-start">
                                <ul class="mb-0 ps-3">
                                    <?php foreach ($order_items[$order['id']] ?? [] as $item): ?>
                                        <li>
                                            <?= htmlspecialchars($item['ten']) ?> (x<?= $item['quantity'] ?>)
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 d-flex align-items-center justify-content-center">
                        <a href="/pages/account/order" class="btn btn-sm text-white background">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>