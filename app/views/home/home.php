<div class="container-fluid mt-2">
  <div class="container">
    <div class="row">
      <!-- menu trái: ẩn trên mobile -->
      <div class="col-lg-2 col-md-3 bg-body-secondary d-none d-md-block rounded-4 mt-3">
        <h5 class="text-center mt-3">Danh mục</h5>
        <ul class="list-unstyled ms-3">
          <li><a class="content-animation" href=""><i class="bi bi-laptop"></i> Laptop</a></li>
          <li><a class="content-animation" href="/pages/product?loai=Monitor"><i class="bi bi-display"></i> Màn hình</a></li>
          <li><a class="content-animation" href="/pages/product?loai=Mouse"><i class="bi bi-mouse"></i> Chuột</a></li>
          <li><a class="content-animation" href=""><i class="bi bi-speaker"></i> Loa</a></li>
          <li><a class="content-animation" href="/pages/product?loai=Keyboard"><i class="bi bi-keyboard"></i> Bàn phím</a></li>
          <li><a class="content-animation" href=""><i class="bi bi-headphones"></i> Tai nghe</a></li>
          <li><a class="content-animation" href=""><i class="bi bi-gift"></i> Ưu đãi</a></li>
        </ul>
      </div>

      <!-- banner chính + phụ -->
      <div class="col-lg-10 col-md-9 col-12">
        <div class="row">
          <!-- banner chính -->
          <div class="col-lg-8 col-md-8 col-12 d-block mt-3">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel"
              data-bs-interval="2000">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="0" class="active" aria-current="true"
                  aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="2" aria-label="Slide 3"></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="/Images/Logo/banner_13.jpg" class="img-fluid w-100 carousel-img" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="/Images/Logo/banner12.jpg" class="img-fluid w-100 carousel-img" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="/Images/Logo/banner6.jpg" class="img-fluid w-100 carousel-img" alt="...">
                </div>
              </div>
            </div>
          </div>

          <!-- banner phụ: ẩn trên mobile - right -->
          <div class="col-lg-4 col-md-4 d-none d-md-block">
            <div class="mb-2">
              <a href="">
                <img src="/Images/Logo/banner_right.jpg" class="img-fluid w-100 banner-img" alt="">
              </a>
            </div>
            <div class="mb-2">
              <a href="">
                <img src="/Images/Logo/banner_bottom1.jpg" class="img-fluid w-100 banner-img" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- banner phụ: ẩn trên mobile - bottom -->
      <div class="row mt-3 d-flex flex-nowrap overflow-auto nav gap-2 px-2 no-scroll-md">
        <div class="col-6 col-md-3 flex-shrink-0">
          <a href="">
            <img src="/Images/Logo/loa.png" class="img-fluid w-100 banner-img" alt="">
          </a>
        </div>
        <div class="col-6 col-md-3 flex-shrink-0">
          <a href="/pages/product?loai=Monitor">
            <img src="/Images/Logo/manhinh.png" class="img-fluid w-100 banner-img" alt="">
          </a>
        </div>
        <div class="col-6 col-md-3 flex-shrink-0">
          <a href="/pages/product?loai=Mouse">
            <img src="/Images/Logo/chuot.png" class="img-fluid w-100 banner-img" alt="">
          </a>
        </div>
        <div class="col-6 col-md-3 flex-shrink-0">
          <a href="">
            <img src="/Images/Logo/cpu.png" class="img-fluid w-100 banner-img" alt="">
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container my-5">
  <h2 class="text-center mb-4">SẢN PHẨM MỚI</h2>
  <?php if (empty($newProducts)): ?>
    <div class="alert alert-info text-center">Không tìm thấy sản phẩm nào.</div>
  <?php else: ?>
    <div class="swiper product-swiper">
      <div class="swiper-wrapper mb-5">
        <?php foreach ($newProducts as $product): ?>
          <div class="swiper-slide">
            <div class="card h-100 product-slider-card">
              <span class="label-new">New</span>
              <a href="/pages/product/productdetail?id=<?= $product['id'] ?>">
                <img src="<?= '/Images/' . html_escape($product['loai']) . '/' . html_escape($product['hinhanh1']) ?>"
                  class="card-img-top"
                  alt="<?= html_escape($product['ten']) ?>">
              </a>
              <div class="card-body">
                <h5 class="card-title card-titles"><?= html_escape($product['ten']) ?></h5>
                <p class="card-text fw-bold text-danger"><?= number_format($product['gia']) ?> VNĐ</p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  <?php endif; ?>
</div>

<div class="container my-5">
  <h2 class="text-center mb-4">SẢN PHẨM ĐÃ XEM GẦN ĐÂY</h2>
  <?php if (empty($recentlyViewed)): ?>
    <div class="alert alert-warning text-center">Bạn chưa xem sản phẩm nào.</div>
  <?php else: ?>
    <div class="swiper product-swiper">
      <div class="swiper-wrapper mb-5">
        <?php foreach ($recentlyViewed as $product): ?>
          <div class="swiper-slide">
            <div class="card h-100 product-slider-card">
              <span class="label-new">New</span>
              <a href="/pages/product/productdetail?id=<?= $product['id'] ?>">
                <img src="<?= '/Images/' . html_escape($product['loai']) . '/' . html_escape($product['hinhanh1']) ?>"
                  class="card-img-top"
                  alt="<?= html_escape($product['ten']) ?>">
              </a>
              <div class="card-body">
                <h5 class="card-title card-titles"><?= html_escape($product['ten']) ?></h5>
                <p class="card-text fw-bold text-danger"><?= number_format($product['gia']) ?> VNĐ</p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  <?php endif; ?>
</div>

