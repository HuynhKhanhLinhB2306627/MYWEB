<div class="container my-5">
    <h3 class="mb-4">Lịch sử đơn hàng</h3>
    <?php if (empty($orders)): ?>
        <div class="alert alert-warning">Bạn chưa có đơn hàng nào.</div>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <strong>Mã đơn hàng:</strong> <?= html_escape($order['order_code']) ?><br>
                        <strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?>
                    </div>
                    <div class="text-start text-md-end mt-2 mt-md-0">
                        <strong>Trạng thái: </strong>
                        <span class="badge 
                            <?php 
                                switch ($order['status']) {
                                    case 'Đã giao': echo 'bg-success'; break;
                                    case 'Đang giao hàng': echo 'bg-primary'; break;
                                    case 'Đã hủy': echo 'bg-danger'; break;
                                    default: echo 'bg-warning text-dark';
                                }
                            ?>">
                            <?= html_escape($order['status']) ?>
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th class="text-end pe-3">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php // *** PHẦN HIỂN THỊ CHI TIẾT SẢN PHẨM *** ?>
                            <?php if (!empty($order_items[$order['id']])): ?>
                                <?php foreach ($order_items[$order['id']] as $item): ?>
                                    <tr>
                                        <td class="ps-3"><?= html_escape($item['ten']) ?></td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td><?= number_format($item['price']) ?> VND</td>
                                        <td class="text-end pe-3"><?= number_format($item['price'] * $item['quantity']) ?> VND</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center p-3">Không có thông tin chi tiết cho đơn hàng này.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    <strong>Tổng cộng: <span class="text-danger fw-bold"><?= number_format($order['total_price']) ?> VND</span></strong>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>