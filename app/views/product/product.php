<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasFilters" aria-labelledby="offcanvasFiltersLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasFiltersLabel"><i class="fa-solid fa-filter"></i> BỘ LỌC</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card-body">
            <h6 class="fw-bold">Danh mục</h6>
            <div class="list-group list-group-flush">
                <a href="?loai=all" class="list-group-item list-group-item-action filter-control <?= !$selected_loai || $selected_loai === 'all' ? 'active' : '' ?>">Tất cả sản phẩm</a>
                <?php foreach ($categories as $category) : ?>
                    <a href="?loai=<?= urlencode($category['loai']) ?>" class="list-group-item list-group-item-action filter-control <?= ($selected_loai === $category['loai']) ? 'active' : '' ?>">
                        <?= html_escape($category['loai']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <hr>
            <h6 class="fw-bold mt-3">Khoảng giá</h6>
            <div class="form-check"><input class="form-check-input filter-control" type="radio" name="priceRange" id="price_all_mobile" value="all" <?= !$price_range || $price_range === 'all' ? 'checked' : '' ?>><label class="form-check-label" for="price_all_mobile">Tất cả</label></div>
            <div class="form-check"><input class="form-check-input filter-control" type="radio" name="priceRange" id="price1_mobile" value="0-1000000" <?= ($price_range === '0-1000000') ? 'checked' : '' ?>><label class="form-check-label" for="price1_mobile">Dưới 1.000.000đ</label></div>
            <div class="form-check"><input class="form-check-input filter-control" type="radio" name="priceRange" id="price2_mobile" value="1000000-3000000" <?= ($price_range === '1000000-3000000') ? 'checked' : '' ?>><label class="form-check-label" for="price2_mobile">1.000.000đ - 3.000.000đ</label></div>
            <div class="form-check"><input class="form-check-input filter-control" type="radio" name="priceRange" id="price3_mobile" value="3000000-5000000" <?= ($price_range === '3000000-5000000') ? 'checked' : '' ?>><label class="form-check-label" for="price3_mobile">3.000.000đ - 5.000.000đ</label></div>
            <div class="form-check"><input class="form-check-input filter-control" type="radio" name="priceRange" id="price4_mobile" value="5000000" <?= ($price_range === '5000000') ? 'checked' : '' ?>><label class="form-check-label" for="price4_mobile">Trên 5.000.000đ</label></div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-3 d-none d-lg-block">
            <div class="card">
                <div class="card-header fw-bold"><i class="fa-solid fa-filter"></i> BỘ LỌC</div>
                <div class="card-body">
                    <h6 class="fw-bold">Danh mục</h6>
                    <div class="list-group list-group-flush">
                        <a href="?loai=all" class="list-group-item list-group-item-action filter-control <?= !$selected_loai || $selected_loai === 'all' ? 'active' : '' ?>">Tất cả sản phẩm</a>
                        <?php foreach ($categories as $category) : ?>
                            <a href="?loai=<?= urlencode($category['loai']) ?>" class="list-group-item list-group-item-action filter-control <?= ($selected_loai === $category['loai']) ? 'active' : '' ?>">
                                <?= html_escape($category['loai']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <hr>
                    <h6 class="fw-bold mt-3">Khoảng giá</h6>
                    <div class="form-check"><input class="form-check-input filter-control" type="radio" name="priceRange" id="price_all" value="all" <?= !$price_range || $price_range === 'all' ? 'checked' : '' ?>><label class="form-check-label" for="price_all">Tất cả</label></div>
                    <div class="form-check"><input class="form-check-input filter-control" type="radio" name="priceRange" id="price1" value="0-1000000" <?= ($price_range === '0-1000000') ? 'checked' : '' ?>><label class="form-check-label" for="price1">Dưới 1.000.000đ</label></div>
                    <div class="form-check"><input class="form-check-input filter-control" type="radio" name="priceRange" id="price2" value="1000000-3000000" <?= ($price_range === '1000000-3000000') ? 'checked' : '' ?>><label class="form-check-label" for="price2">1.000.000đ - 3.000.000đ</label></div>
                    <div class="form-check"><input class="form-check-input filter-control" type="radio" name="priceRange" id="price3" value="3000000-5000000" <?= ($price_range === '3000000-5000000') ? 'checked' : '' ?>><label class="form-check-label" for="price3">3.000.000đ - 5.000.000đ</label></div>
                    <div class="form-check"><input class="form-check-input filter-control" type="radio" name="priceRange" id="price4" value="5000000" <?= ($price_range === '5000000') ? 'checked' : '' ?>><label class="form-check-label" for="price4">Trên 5.000.000đ</label></div>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="d-flex align-items-center bg-white p-2 rounded shadow-sm mb-3">
                <button class="btn btn-outline-dark d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilters" aria-controls="offcanvasFilters">
                    <i class="fa-solid fa-filter"></i> Lọc
                </button>
                <span class="fw-bold me-2 d-none d-lg-block">Sắp xếp theo:</span>
                <div class="ms-auto">
                    <div class="dropdown">
                        <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?= html_escape($sort_text) ?></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item filter-control" href="?sort=default">Mặc định</a></li>
                            <li><a class="dropdown-item filter-control" href="?sort=price_asc">Giá: Tăng dần</a></li>
                            <li><a class="dropdown-item filter-control" href="?sort=price_desc">Giá: Giảm dần</a></li>
                            <li><a class="dropdown-item filter-control" href="?sort=name_asc">Tên: A-Z</a></li>
                            <li><a class="dropdown-item filter-control" href="?sort=name_desc">Tên: Z-A</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
                <?php if (empty($sanphams)): ?><div class="col-12">
                        <p class="text-center mt-5">Không tìm thấy sản phẩm nào phù hợp.</p>
                    </div>
                    <?php else: ?><?php foreach ($sanphams as $sanpham) : ?><div class="col">
                        <div class="card h-100 product-card-hover">
                            <a href="/pages/product/productdetail?id=<?= html_escape($sanpham['id']) ?>">
                                <img src="<?= '/Images/' . html_escape($sanpham['loai']) . '/' . html_escape($sanpham['hinhanh1']) ?>" class="card-img-top p-2" alt="<?= html_escape($sanpham['ten']) ?>">
                            </a>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title" style="min-height: 48px;">
                                    <a href="/pages/product/productdetail?id=<?= html_escape($sanpham['id']) ?>" class="text-decoration-none text-dark fs-6"><?= html_escape($sanpham['ten']) ?></a>
                                </h5>
                                <p class="card-text fw-bold text-danger mt-auto">
                                    <?= html_escape(number_format($sanpham['gia'])) ?> VNĐ
                                </p>
                            </div>
                        </div>
                    </div><?php endforeach; ?><?php endif; ?>
            </div>
        </div>
    </div>
</div>
