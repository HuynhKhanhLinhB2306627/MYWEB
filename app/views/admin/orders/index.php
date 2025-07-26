<h1><i class="fas fa-file-invoice-dollar me-2"></i>Quản lý Đơn hàng</h1>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success" role="alert"><?= session_get_once('success') ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['errors'])): ?>
    <div class="alert alert-danger" role="alert"><?= is_array($errors = session_get_once('errors')) ? implode('<br>', $errors) : $errors ?></div>
<?php endif; ?>

<?php if (empty($orders)): ?>
    <div class="alert alert-warning mt-4">Chưa có đơn hàng nào để quản lý.</div>
<?php else: ?>
    <?php $statuses = ['Đang xử lý', 'Đang giao hàng', 'Đã giao', 'Đã hủy']; ?>
    
    <div class="accordion mt-4" id="ordersAccordion">
        <?php foreach ($orders as $order): ?>
            <div class="card mb-3">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-<?= $order['id'] ?>">
                        <button class="accordion-button collapsed p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?= $order['id'] ?>" aria-expanded="false" aria-controls="collapse-<?= $order['id'] ?>">
                            <div class="d-flex flex-wrap justify-content-between align-items-center w-100">
                                <span class="fw-bold me-3 mb-1">#<?= html_escape($order['order_code']) ?></span>
                                <span class="me-3 mb-1"><i class="fas fa-user text-muted"></i> <?= html_escape($order['full_name']) ?></span>
                                <span class="me-3 mb-1"><i class="fas fa-calendar-alt text-muted"></i> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></span>
                                <span class="fw-bold text-danger me-auto mb-1"><?= number_format($order['total_price']) ?> VNĐ</span>
                                <span class="badge ms-3 mb-1 fs-6
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
                        </button>
                    </h2>
                    <div id="collapse-<?= $order['id'] ?>" class="accordion-collapse collapse" data-bs-parent="#ordersAccordion">
                        <div class="accordion-body">
                            
                            <div class="row gy-3 mb-3">
                                <div class="col-md-7">
                                    <h5 class="mb-2">Thông tin giao hàng</h5>
                                    <p class="mb-1"><strong>Khách hàng:</strong> <?= html_escape($order['full_name']) ?></p>
                                    <p class="mb-1"><strong>Điện thoại:</strong> <a href="tel:<?= html_escape($order['phone']) ?>" class="text-decoration-none"><?= html_escape($order['phone']) ?></a></p>
                                    <p class="mb-0"><strong>Địa chỉ:</strong> <?= html_escape($order['address']) ?></p>
                                </div>
                                <div class="col-md-5">
                                    <h5 class="mb-2">Cập nhật trạng thái</h5>
                                    <form action="/admin/orders/update_status" method="POST" class="d-flex">
                                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                        <select name="status" class="form-select me-2">
                                            <?php foreach ($statuses as $status): ?>
                                                <option value="<?= $status ?>" <?= ($order['status'] == $status) ? 'selected' : '' ?>>
                                                    <?= $status ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                    </form>
                                </div>
                            </div>

                            <hr>
                            
                            <h5 class="mt-3">Chi tiết sản phẩm</h5>
                            <table class="table table-sm table-hover table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Sản phẩm</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-end">Đơn giá</th>
                                        <th class="text-end pe-3">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($order_items[$order['id']])): ?>
                                        <?php foreach ($order_items[$order['id']] as $item): ?>
                                            <tr>
                                                <td class="ps-3"><?= html_escape($item['ten']) ?></td>
                                                <td class="text-center"><?= $item['quantity'] ?></td>
                                                <td class="text-end"><?= number_format($item['price']) ?> VND</td>
                                                <td class="text-end pe-3 fw-bold"><?= number_format($item['price'] * $item['quantity']) ?> VND</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="4" class="text-center p-3">Không có thông tin sản phẩm.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>