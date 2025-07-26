<h1>Chỉnh sửa sản phẩm: <?= html_escape($product['ten']) ?></h1>
<?php $errors = session_get_once('errors', []); ?>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <p class="mb-0"><?= html_escape($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form action="/admin/products/update/<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
    <div class="mb-3">
        <label for="ten" class="form-label">Tên sản phẩm</label>
        <input type="text" class="form-control" id="ten" name="ten" value="<?= html_escape($product['ten']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="loai" class="form-label">Loại sản phẩm</label>
        <select class="form-select" id="loai" name="loai" required>
            <option value="Mouse" <?= ($product['loai'] === 'Mouse') ? 'selected' : '' ?>>Mouse</option>
            <option value="Keyboard" <?= ($product['loai'] === 'Keyboard') ? 'selected' : '' ?>>Keyboard</option>
            <option value="Monitor" <?= ($product['loai'] === 'Monitor') ? 'selected' : '' ?>>Monitor</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="gia" class="form-label">Giá</label>
        <input type="number" class="form-control" id="gia" name="gia" value="<?= html_escape($product['gia']) ?>" required>
    </div>

    <div class="mb-3">
        <label for="mota" class="form-label">Mô tả</label>
        <textarea class="form-control" id="mota" name="mota" rows="5"><?= html_escape($product['mota']) ?></textarea>
    </div>

    <div class="row">
        <?php for ($i = 1; $i <= 4; $i++): $field = 'hinhanh' . $i; ?>
            <div class="col-md-3 mb-3">
                <label for="<?= $field ?>" class="form-label">Hình ảnh <?= $i ?></label>
                <input type="file" class="form-control" id="<?= $field ?>" name="<?= $field ?>">
                <?php if (!empty($product[$field])): ?>
                    <div class="mt-2">
                        <img src="/Images/<?= html_escape($product['loai']) ?>/<?= html_escape($product[$field]) ?>" alt="Ảnh hiện tại" width="100">
                        <p class="text-muted small">Ảnh hiện tại</p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endfor; ?>
    </div>

    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
    <a href="/admin/products" class="btn btn-secondary">Hủy</a>
</form>