<div class="container-fluid my-5">
    <div class="container text-center">
        <h3 class="mb-4">🛒 Thông Tin Giỏ Hàng</h3>
        <div class="row gap-2">
            <div class="col-lg-7 col-12 border border-2 rounded-3">
                <div id="cart-items">
                    <?php if (!empty($cart_items)): ?>
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cart_items as $item): ?>
                                    <tr data-id="<?= $item['id'] ?>" data-product-id="<?= $item['product_id'] ?>">
                                        <td style="width: 100px;">
                                            <img src="<?= '/Images/' . html_escape($item['loai']) . '/' . html_escape($item['hinhanh1']) ?>" alt="<?= html_escape($item['ten']) ?>" style="width: 100%;">
                                        </td>
                                        <td><?= html_escape($item['ten']) ?></td>
                                        <td><?= number_format($item['price']) ?> VND</td>
                                        <td>
                                            <div class="input-group input-group-sm" style="width: 120px;">
                                                <button type="button" class="btn btn-outline-secondary btn-minus">−</button>
                                                <input type="text" class="form-control text-center quantity-input" value="<?= $item['quantity'] ?>" readonly>
                                                <button type="button" class="btn btn-outline-secondary btn-plus">+</button>
                                            </div>
                                        </td>
                                        <td class="item-total"><?= number_format($item['price'] * $item['quantity']) ?> VND</td>
                                        <td>
                                            <form method="POST" action="/pages/cart/remove" style="display:inline;">
                                                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                                <input type="hidden" name="product_id" value="<?= html_escape($item['product_id']) ?>">
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-muted py-4">🛒 Giỏ hàng của bạn đang trống.</p>
                    <?php endif; ?>

                </div>
            </div>
            <div class="col-lg-4 col-12 border border-2 rounded-3">
                <h4 class="mt-3">🧾 Tổng Đơn Hàng</h4>
                <div class="row">
                    <div class="col-6">
                        <ul class="list-unstyled text-start fw-bold ps-4">
                            <li class="mb-4">Tạm tính:</li>
                            <li>Phí vận chuyển:</li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled text-end">
                            <li class="mb-4" id="subtotal">
                                <?php $subtotal = 0; foreach ($cart_items as $item) { $subtotal += $item['price'] * $item['quantity']; } echo number_format($subtotal); ?> VND
                            </li>
                            <li id="shipping"><?= ($subtotal > 0) ? number_format(30000) : 0 ?> VND</li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <ul class="list-unstyled text-start fw-bold ps-4">
                            <li>Tổng Cộng:</li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled text-end">
                            <li id="total">
                                <?= ($subtotal > 0) ? number_format($subtotal + 30000) : 0 ?> VND
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>
                <p class="text-start ms-4 fw-bold">Mã Giảm Giá:</p>
                <div class=" d-flex gap-2 mb-2 justify-content-between">
                    <input class="form-control w-75" type="text" name="offer" placeholder="Nhập mã giảm giá tại đây...">
                    <button class="btn btn-outline-danger">Áp dụng</button>
                </div>
                <form action="/pages/cart/checkout" method="get">
                    <button type="submit" class="btn btn-sm btn-outline-danger fw-bold w-100 py-2">Thanh Toán</button>
                </form>
                <div>
                    <p><a class="content-animation" href="/pages/product">⬅ Tiếp tục mua sắm</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function getNumberFromCurrency(str) {
    return Number(str.replace(/[^0-9]/g, ''));
}

function updateQuantityAjax(productId, newQuantity, row) {
    fetch('/pages/cart/update-quantity', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `product_id=${encodeURIComponent(productId)}&quantity=${encodeURIComponent(newQuantity)}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // Lấy giá đúng (không bị lỗi dấu phẩy)
            const price = getNumberFromCurrency(row.querySelector('td:nth-child(3)').textContent);
            row.querySelector('.item-total').textContent = (price * newQuantity).toLocaleString() + ' VND';
            // Cập nhật tổng đơn hàng
            document.getElementById('subtotal').textContent = data.subtotal + ' VND';
            document.getElementById('shipping').textContent = data.shipping + ' VND';
            document.getElementById('total').textContent = data.total + ' VND';
        } else {
            alert(data.message || 'Có lỗi xảy ra!');
        }
    });
}

document.querySelectorAll('.btn-plus').forEach(btn => {
    btn.addEventListener('click', function() {
        const row = this.closest('tr');
        const input = row.querySelector('.quantity-input');
        let val = parseInt(input.value);
        val++;
        input.value = val;
        updateQuantityAjax(row.getAttribute('data-product-id'), val, row);
    });
});
document.querySelectorAll('.btn-minus').forEach(btn => {
    btn.addEventListener('click', function() {
        const row = this.closest('tr');
        const input = row.querySelector('.quantity-input');
        let val = parseInt(input.value);
        if (val > 1) {
            val--;
            input.value = val;
            updateQuantityAjax(row.getAttribute('data-product-id'), val, row);
        }
    });
});
</script>
