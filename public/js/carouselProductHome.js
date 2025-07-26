var swiper = new Swiper(".product-swiper", {
    slidesPerView: 2.5,
    spaceBetween: 10,
    loop: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    breakpoints: {
        576: { slidesPerView: 2, spaceBetween: 20, },
        768: { slidesPerView: 3, spaceBetween: 30, },
        992: { slidesPerView: 4, spaceBetween: 40, },
        1200: { slidesPerView: 5, spaceBetween: 50, },
    },
});

