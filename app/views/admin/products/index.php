<h1>Quản lý Sản phẩm</h1>

<?php if (!empty($success)): ?>
    <div class="alert alert-success"><?= $success ?></div>
<?php endif; ?>
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger"><?= is_array($errors) ? implode('<br>', $errors) : $errors ?></div>
<?php endif; ?>

<div class="mb-3">
    <a href="/admin/products/create" class="btn btn-success"><i class="fa fa-plus"></i> Thêm sản phẩm mới</a>
</div>

<table id="productsTable" class="table table-bordered table-striped" style="width:100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Loại</th>
            <th style="width: 150px;">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= html_escape($product['id']) ?></td>
                <td><img src="/Images/<?= html_escape($product['loai']) ?>/<?= html_escape($product['hinhanh1']) ?>" alt="" width="100"></td>
                <td><?= html_escape($product['ten']) ?></td>
                <td><?= number_format($product['gia']) ?> VNĐ</td>
                <td><?= html_escape($product['loai']) ?></td>
                <td>
                    <a href="/admin/products/edit/<?= $product['id'] ?>" class="btn btn-primary btn-sm">Sửa</a>
                    <form action="/admin/products/delete/<?= $product['id'] ?>" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#productsTable').DataTable();
});
</script>