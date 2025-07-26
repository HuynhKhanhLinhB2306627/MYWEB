<div class="container my-5 border border-warning rounded" style="max-width: 450px;">
    <h2 class="text-center mt-4">Đăng Nhập</h2>

    <?php $errors = session_get_once('errors', []); ?>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p class="mb-0"><?= html_escape($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <form action="/pages/login" method="POST">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    Ghi nhớ tôi
                </label>
            </div>
            <a href="#">Quên mật khẩu?</a>
        </div>
        <button type="submit" class="btn btn-warning w-100">Đăng Nhập</button>
    </form>
    <p class="mt-3 text-center">Chưa có tài khoản? <a href="/pages/logup">Đăng ký ngay</a></p>
</div>