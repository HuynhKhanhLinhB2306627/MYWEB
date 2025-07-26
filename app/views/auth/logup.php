<div class="container my-5 border border-warning rounded" style="max-width: 450px;">
    <h2 class="text-center mt-4">Đăng Ký Tài Khoản</h2>
    
    <?php $errors = session_get_once('errors', []); ?>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p class="mb-0"><?= html_escape($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="/pages/logup" method="POST">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <div class="mb-3">
            <label for="fullName" class="form-label">Họ và Tên</label>
            <input type="text" class="form-control" id="fullName" name="fullName" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="tel" class="form-control" id="phone" name="phone">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="repeatPassword" class="form-label">Nhập lại mật khẩu</label>
            <input type="password" class="form-control" id="repeatPassword" name="repeatPassword" required>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="agree" id="agree" required>
            <label class="form-check-label" for="agree">
                Tôi đồng ý với các <a href="#">điều khoản và chính sách</a>.
            </label>
        </div>
        <button type="submit" class="btn btn-warning w-100">Đăng Ký</button>
    </form>
    <p class="mt-3 text-center">Đã có tài khoản? <a href="/pages/login">Đăng nhập ngay</a></p>
</div>