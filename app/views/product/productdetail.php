<div class="container my-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2 rounded-3">
            <li class="breadcrumb-item"><a href="/pages/home">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="/pages/product?loai=<?= urlencode($product['loai']) ?>"><?= html_escape($product['loai']) ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= html_escape($product['ten']) ?></li>
        </ol>
    </nav>
    <div class="bg-white p-3 p-lg-4 rounded">
        <div class="row">
            <div class="col-lg-5 product-gallery">
                <div class="ratio ratio-1x1 mb-3 main-image-container">
                    <img src="<?= '/Images/' . html_escape($product['loai']) . '/' . html_escape($product['hinhanh1']) ?>" id="mainProductImage" alt="<?= html_escape($product['ten']) ?>">
                </div>
                <div class="d-flex gap-2 thumbnail-images">
                    <?php for ($i = 1; $i <= 4; $i++): $image_col = 'hinhanh' . $i;
                        if (!empty($product[$image_col])): ?>
                            <img src="<?= '/Images/' . html_escape($product['loai']) . '/' . html_escape($product[$image_col]) ?>" class="<?= ($i == 1) ? 'active' : '' ?>" alt="Thumbnail <?= $i ?>" onclick="changeImage('<?= '/Images/' . html_escape($product['loai']) . '/' . html_escape($product[$image_col]) ?>', this)">
                    <?php endif;
                    endfor; ?>
                </div>
            </div>
            <div class="col-lg-7 ps-lg-5 mt-4 mt-lg-0">
                <h1 class="fw-bolder mb-2"><?= html_escape($product['ten']) ?></h1>
                <div class="d-flex align-items-center mb-3">
                    <span class="text-muted me-3">Mã SP: <?= html_escape($product['id']) ?></span>
                    <span class="stock-status in-stock">Còn hàng</span>
                </div>
                <div class="fs-1 fw-bold text-danger mb-4">
                    <?= html_escape(number_format($product['gia'])) ?> <span class="fs-4">VNĐ</span>
                </div>
                <div class="row mb-4 align-items-center">
                    <label for="quantity" class="col-sm-3 col-form-label fw-bold">Số lượng:</label>
                    <div class="col-sm-5">
                        <div class="input-group" style="width: 150px;">
                            <button class="btn btn-outline-secondary" type="button" id="button-minus">-</button>
                            <input type="text" id="quantity" class="form-control text-center" value="1" readonly>
                            <button class="btn btn-outline-secondary" type="button" id="button-plus">+</button>
                        </div>
                    </div>
                </div>
                <div class="row g-2 mb-4">
                    <div class="col-12 col-md-8">
                        <form method="POST" action="/pages/cart/add" style="margin:0;">
                            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                            <input type="hidden" name="product_id" value="<?= html_escape($product['id']) ?>">
                            <input type="hidden" name="price" value="<?= (int)$product['gia'] ?>">
                            <input type="hidden" name="quantity" id="form-quantity" value="1">
                            <button type="submit" class="btn btn-danger btn-lg w-100">
                                <i class="fa-solid fa-cart-plus"></i> Thêm vào giỏ hàng
                            </button>
                        </form>
                    </div>
                    <div class="col-12 col-md-4">
                        <button class="btn btn-outline-secondary btn-lg w-100" type="button">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                    </div>
                </div>
                <script>
                    // Đồng bộ số lượng khi bấm + -
                    document.getElementById('button-plus').addEventListener('click', function() {
                        let q = document.getElementById('quantity');
                        let fq = document.getElementById('form-quantity');
                        q.value = parseInt(q.value) + 1;
                        fq.value = q.value;
                    });
                    document.getElementById('button-minus').addEventListener('click', function() {
                        let q = document.getElementById('quantity');
                        let fq = document.getElementById('form-quantity');
                        if (parseInt(q.value) > 1) {
                            q.value = parseInt(q.value) - 1;
                            fq.value = q.value;
                        }
                    });
                </script>

                <div class="policy-box p-3 mb-4">
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex align-items-center mb-2 policy-item"><i class="fa-solid fa-shield-halved fa-fw me-2"></i><span>Bảo hành chính hãng 12 tháng.</span></li>
                        <li class="d-flex align-items-center mb-2 policy-item"><i class="fa-solid fa-box-open fa-fw me-2"></i><span>Hàng nguyên seal, mới 100%.</span></li>
                        <li class="d-flex align-items-center policy-item"><i class="fa-solid fa-truck-fast fa-fw me-2"></i><span>Miễn phí giao hàng toàn quốc.</span></li>
                    </ul>
                </div>
                <div class="product-description">
                    <h5 class="fw-bold border-bottom pb-2">Mô tả sản phẩm</h5>
                    <div class="lh-base" style="text-align: justify;"><?= nl2br(html_escape($product['mota'])) ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($related_products)): ?>
        <div class="mt-5">
            <h3 class="text-center mb-4">Sản phẩm liên quan</h3>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3">
                <?php foreach ($related_products as $related): ?>
                    <div class="col">
                        <div class="card h-100 product-card-hover related-product-card">
                            <a href="/pages/product/productdetail?id=<?= $related['id'] ?>" class="ratio ratio-1x1 card-img-container">
                                <img src="<?= '/Images/' . html_escape($product['loai']) . '/' . html_escape($related['hinhanh1']) ?>" class="card-img-top" alt="<?= html_escape($related['ten']) ?>">
                            </a>
                            <div class="card-body text-center p-2">
                                <h6 class="card-title mb-1">
                                    <a href="/pages/product/productdetail?id=<?= $related['id'] ?>"
                                        class="text-decoration-none text-dark stretched-link"><?= html_escape($related['ten']) ?></a>
                                </h6>
                                <p class="card-text fw-bold text-danger mb-0"><?= html_escape(number_format($related['gia'])) ?> VNĐ</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<div id="toast-container" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;"></div>
