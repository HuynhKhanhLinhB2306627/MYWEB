<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/Images/Logo/LogoTL2.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="/css/bootstrap_color.css">
  <link rel="stylesheet" href="/css/format.css">
  <link rel="stylesheet" href="/css/Product.css">
  <link rel="stylesheet" href="/css/color.css">

  <title>LT - Linh Kiện PC</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg background">
    <div class="container-fluid mx-lg-5 d-flex flex-wrap flex-lg-nowrap">
      <div class="order-1 order-lg-1 flex-shrink-0">
        <ul class="nav">
          <li class="nav-item">
            <a href="/pages/home" class="nav-link">
              <img src="/Images/Logo/LogoTL2.png" alt="LT Logo" style="width: 50px; height: 50px;">
            </a>
          </li>
          <li class="nav-item">
            <a href="/pages/home" class="nav-link">
              <h3 class="fs-5">LT | Linh kiện</h3>
              LT.store.com
            </a>
          </li>
        </ul>
      </div>
      <!-- Navigation Links -->
      <div class="order-3 order-lg-2 w-100 w-lg-auto flex-lg-grow-1 d-flex justify-content-center overflow-auto">
        <div class="d-flex gap-3 justify-content-center mt-2 mt-lg-0 flex-nowrap">
          <ul class="nav flex-row flex-nowrap justify-content-center">
            <li class="nav-item">
              <a class="nav-link content-animation fw-bold" href="/pages/home">Trang chủ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link content-animation fw-bold" href="/pages/product">Sản phẩm</a>
            </li>
            <li class="nav-item">
              <a class="nav-link content-animation fw-bold" href="/pages/contact">Hệ Thống</a>
            </li>
            <li class="nav-item">
              <a class="nav-link content-animation fw-bold" href="/pages/contact">Liên hệ</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- Icons -->
      <div class="order-2 order-lg-3 ms-auto ms-lg-0 flex-shrink-0">
        <div class="d-flex align-items-center gap-3">
          <ul class="nav">
            <li class="nav-item">
              <button type="button" class="btn btn-light btn-outline-light blue-500 d-flex align-items-center gap-2 ps-4 pe-3 py-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <span class="fw-semibold">Nhập từ khóa tìm kiếm ... </span>
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>

            </li>
            <li class="nav-item">
              <a class="btn" href="/pages/cart">
                <i class="fa-solid fa-cart-shopping fs-5"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="btn" href="/pages/account">
                <i class="fa-solid fa-user fs-5"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header border-0">
          <form class="w-100" role="search">
            <div class="input-group">
              <input id="searchInput" class="form-control" type="search" placeholder="Nhập tên sản phẩm" oninput="searchProduct()" />
              <button class="btn btn-light btn-outline-light blue-500" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </div>
          </form>
        </div>

        <div class="modal-body" id="searchResult">
          <p class="text-muted">Kết quả tìm kiếm sẽ hiển thị ở đây...</p>
        </div>


      </div>
    </div>
  </div>

  <script>
    const products = <?= json_encode($allProducts, JSON_UNESCAPED_UNICODE) ?>;
  </script>
  <script>
    function searchProduct() {
      const keyword = document.getElementById('searchInput').value.toLowerCase();
      const resultBox = document.getElementById('searchResult');
      resultBox.innerHTML = '';

      if (keyword.trim() === '') {
        resultBox.innerHTML = '<p class="text-muted">Vui lòng nhập từ khóa để tìm kiếm.</p>';
        return;
      }

      const filtered = products.filter(p =>
        p.ten.toLowerCase().includes(keyword)
      );

      if (filtered.length === 0) {
        resultBox.innerHTML = '<p class="text-danger">Không tìm thấy sản phẩm nào.</p>';
      } else {
        filtered.slice(0, 10).forEach(p => {
          resultBox.innerHTML += `
        <a href="/pages/product/productdetail?id=${p.id}" class="text-decoration-none text-dark">
          <div class="d-flex align-items-center gap-3 py-2 border-bottom">
            <img src="/Images/${p.loai}/${p.hinhanh1}" style="width: 50px; height: 50px; object-fit: cover;" />
            <div>
              <p class="m-0 fw-semibold">${p.ten}</p>
              <p class="m-0 text-muted">${Number(p.gia).toLocaleString()}₫</p>
            </div>
          </div>
        </a>
        `;
        });
      }
    }
  </script>