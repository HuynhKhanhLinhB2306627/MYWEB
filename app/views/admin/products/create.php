<h1>Thêm sản phẩm mới</h1>
<?php $errors = session_get_once('errors', []); ?>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <p class="mb-0"><?= html_escape($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form action="/admin/products/store" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
    <div class="mb-3">
        <label for="ten" class="form-label">Tên sản phẩm</label>
        <input type="text" class="form-control" id="ten" name="ten" required>
    </div>

    <div class="mb-3">
        <label for="loai" class="form-label">Loại sản phẩm</label>
        <select class="form-select" id="loai" name="loai" required>
            <option value="Mouse">Mouse</option>
            <option value="Keyboard">Keyboard</option>
            <option value="Monitor">Monitor</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="gia" class="form-label">Giá</label>
        <input type="number" class="form-control" id="gia" name="gia" required>
    </div>

    <div class="mb-3">
        <label for="mota" class="form-label">Mô tả</label>
        <textarea class="form-control" id="mota" name="mota" rows="5"></textarea>
    </div>

    <div class="row">
        <div class="col-md-3 mb-3">
            <label for="hinhanh1" class="form-label">Hình ảnh chính</label>
            <input type="file" class="form-control" id="hinhanh1" name="hinhanh1" required>
        </div>
        <div class="col-md-3 mb-3">
            <label for="hinhanh2" class="form-label">Hình ảnh phụ 1</label>
            <input type="file" class="form-control" id="hinhanh2" name="hinhanh2">
        </div>
        <div class="col-md-3 mb-3">
            <label for="hinhanh3" class="form-label">Hình ảnh phụ 2</label>
            <input type="file" class="form-control" id="hinhanh3" name="hinhanh3">
        </div>
        <div class="col-md-3 mb-3">
            <label for="hinhanh4" class="form-label">Hình ảnh phụ 3</label>
            <input type="file" class="form-control" id="hinhanh4" name="hinhanh4">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
    <a href="/admin/products" class="btn btn-secondary">Hủy</a>
</form>