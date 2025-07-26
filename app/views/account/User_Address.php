<div class="row border border-secondary rounded-3 p-4">
    <h5 class="mb-3">Địa chỉ giao hàng</h5>

    <div class="alert alert-warning">
        <strong>Địa chỉ hiện tại của bạn là:</strong><br>
        <span class="fs-5"><?= html_escape($address ?? 'Bạn chưa cập nhật địa chỉ.') ?></span>
    </div>
    <hr>
    
    <form method="POST" action="/pages/account/address">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <div class="mb-3">
            <label for="detail" class="form-label fw-bold">Cập nhật hoặc thay đổi địa chỉ</label>
            <input type="text" id="detail" name="detail" class="form-control" placeholder="Nhập địa chỉ mới tại đây..." required>
        </div>
        <button type="submit" class="btn btn-danger w-100">Lưu thay đổi</button>
    </form>
</div>