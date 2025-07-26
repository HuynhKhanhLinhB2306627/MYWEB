<div class="container my-5">
    <h3>Xác nhận thanh toán</h3>
    <div class="alert alert-warning">
        <strong>Địa chỉ giao hàng:</strong><br>
        <?= html_escape($user->address) ?>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart_items as $item): ?>
            <tr>
                <td><?= html_escape($item['ten']) ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['price']) ?> VND</td>
                <td><?= number_format($item['price'] * $item['quantity']) ?> VND</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="text-end">
        <p><strong>Tạm tính:</strong> <?= number_format($subtotal) ?> VND</p>
        <p><strong>Phí vận chuyển:</strong> <?= number_format($shipping) ?> VND</p>
        <p><strong>Tổng cộng:</strong> <?= number_format($total) ?> VND</p>
    </div>
    <form method="POST" action="/pages/cart/checkout">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <button type="submit" class="btn btn-danger btn-lg">Xác nhận đặt hàng</button>
    </form>
</div> 