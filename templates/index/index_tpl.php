<?php 
// NỘI DUNG CHÍNH (Banner Trang Chủ)
?>

<main class="main-content container">
    <div class="main-grid">
        
        <!-- Banner lớn bên trái - laptop4 -->
        <div class="banner-large">
            <img src="<?= ASSET ?>assets/images/laptop4.jpg" alt="Black Friday Laptop Sale" class="banner-img">
            
            <div class="main-banner-overlay">
                <button class="shop-btn">
                    SHOP NOW
                </button>
            </div>
            <div class="promo-text">
                <p>PROMO:BLACK FRIDAY!</p>
                <p>THIS WEEKEND ONLY</p>
            </div>
        </div>
        
        <!-- Grid 3 hình laptop bên phải -->
        <div class="laptop-grid">
            <div class="laptop-item">
                <img src="<?= ASSET ?>assets/images/laptop1.png" alt="Laptop 1" class="laptop-img">
            </div>
            
            <div class="laptop-item">
                <img src="<?= ASSET ?>assets/images/laptop2.png" alt="Laptop 2" class="laptop-img">
            </div>
            
            <div class="laptop-item">
                <img src="<?= ASSET ?>assets/images/laptop3.png" alt="Laptop 3" class="laptop-img">
            </div>
        </div>
    </div>

    <!-- SẢN PHẨM BÁN CHẠY -->
    <section class="products-section best-selling">
        <div class="section-header">
            <h2 class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#facc15" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="title-icon lightning">
                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                </svg>
                SẢN PHẨM BÁN CHẠY
            </h2>
        </div>
        <div class="products-scroll-wrapper">
            <button class="scroll-arrow scroll-left" onclick="scrollProducts('left')">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
            <div class="products-scroll" id="bestSellingScroll">
                <div class="product-card">
                    <span class="hot-badge">Hot</span>
                    <img src="<?= ASSET ?>assets/images/laptop1.png" alt="Laptop" class="product-img">
                    <div class="product-rating">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#facc15" stroke="#facc15" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                        <span>5.0 (10 đánh giá)</span>
                    </div>
                    <h3 class="product-name">Laptop HP Omen 16-am0127TX</h3>
                    <div class="product-price">
                        <span class="old-price">28.990.000₫</span>
                        <span class="new-price">26.490.000₫</span>
                    </div>
                    <button class="product-btn black-btn">
                        Xem chi tiết
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>
                <div class="product-card">
                    <span class="hot-badge">Hot</span>
                    <img src="<?= ASSET ?>assets/images/laptop2.png" alt="Laptop" class="product-img">
                    <div class="product-rating">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#facc15" stroke="#facc15" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                        <span>5.0 (10 đánh giá)</span>
                    </div>
                    <h3 class="product-name">Laptop HP Omen 16-am0127TX</h3>
                    <div class="product-price">
                        <span class="old-price">28.990.000₫</span>
                        <span class="new-price">26.490.000₫</span>
                    </div>
                    <button class="product-btn black-btn">
                        Xem chi tiết
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>
                <div class="product-card">
                    <span class="hot-badge">Hot</span>
                    <img src="<?= ASSET ?>assets/images/laptop3.png" alt="Laptop" class="product-img">
                    <div class="product-rating">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#facc15" stroke="#facc15" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                        <span>5.0 (10 đánh giá)</span>
                    </div>
                    <h3 class="product-name">Laptop HP Omen 16-am0127TX</h3>
                    <div class="product-price">
                        <span class="old-price">28.990.000₫</span>
                        <span class="new-price">26.490.000₫</span>
                    </div>
                    <button class="product-btn black-btn">
                        Xem chi tiết
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>
                <div class="product-card">
                    <span class="hot-badge">Hot</span>
                    <img src="<?= ASSET ?>assets/images/laptop1.png" alt="Laptop" class="product-img">
                    <div class="product-rating">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#facc15" stroke="#facc15" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                        <span>5.0 (10 đánh giá)</span>
                    </div>
                    <h3 class="product-name">Laptop HP Omen 16-am0127TX</h3>
                    <div class="product-price">
                        <span class="old-price">28.990.000₫</span>
                        <span class="new-price">26.490.000₫</span>
                    </div>
                    <button class="product-btn black-btn">
                        Xem chi tiết
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>
                <div class="product-card">
                    <span class="hot-badge">Hot</span>
                    <img src="<?= ASSET ?>assets/images/laptop2.png" alt="Laptop" class="product-img">
                    <div class="product-rating">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#facc15" stroke="#facc15" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                        <span>5.0 (10 đánh giá)</span>
                    </div>
                    <h3 class="product-name">Laptop HP Omen 16-am0127TX</h3>
                    <div class="product-price">
                        <span class="old-price">28.990.000₫</span>
                        <span class="new-price">26.490.000₫</span>
                    </div>
                    <button class="product-btn black-btn">
                        Xem chi tiết
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>
            </div>
            <button class="scroll-arrow scroll-right" onclick="scrollProducts('right')">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </div>
    </section>

    <!-- SẢN PHẨM NỔI BẬT -->
    <section class="products-section">
        <div class="section-header">
            <h2 class="section-title">SẢN PHẨM NỔI BẬT</h2>
        </div>
        <div class="products-grid">
            <div class="product-card">
                <span class="hot-badge">Hot</span>
                <img src="<?= ASSET ?>assets/images/laptop1.png" alt="Laptop" class="product-img">
                <h3 class="product-name">Laptop HP Omen 16</h3>
                <div class="product-price">
                    <span class="old-price">28.990.000đ</span>
                    <span class="new-price">26.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
            <div class="product-card">
                <span class="hot-badge">Hot</span>
                <img src="<?= ASSET ?>assets/images/laptop2.png" alt="Laptop" class="product-img">
                <h3 class="product-name">Laptop Acer Nitro 5</h3>
                <div class="product-price">
                    <span class="old-price">25.990.000đ</span>
                    <span class="new-price">23.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
            <div class="product-card">
                <span class="hot-badge">Hot</span>
                <img src="<?= ASSET ?>assets/images/laptop3.png" alt="Laptop" class="product-img">
                <h3 class="product-name">Laptop Asus TUF</h3>
                <div class="product-price">
                    <span class="old-price">27.990.000đ</span>
                    <span class="new-price">25.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
            <div class="product-card">
                <span class="hot-badge">Hot</span>
                <img src="<?= ASSET ?>assets/images/laptop1.png" alt="Laptop" class="product-img">
                <h3 class="product-name">Laptop Dell G15</h3>
                <div class="product-price">
                    <span class="old-price">29.990.000đ</span>
                    <span class="new-price">27.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
        </div>
    </section>

    <!-- LAPTOP ACER -->
    <section class="products-section">
        <div class="section-header">
            <h2 class="section-title">LAPTOP ACER</h2>
        </div>
        <div class="products-grid">
            <div class="product-card">
                <img src="<?= ASSET ?>assets/images/laptop1.png" alt="Laptop Acer" class="product-img">
                <h3 class="product-name">Laptop Acer Nitro 5</h3>
                <div class="product-price">
                    <span class="new-price">23.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
            <div class="product-card">
                <img src="<?= ASSET ?>assets/images/laptop2.png" alt="Laptop Acer" class="product-img">
                <h3 class="product-name">Laptop Acer Predator</h3>
                <div class="product-price">
                    <span class="new-price">35.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
            <div class="product-card">
                <img src="<?= ASSET ?>assets/images/laptop3.png" alt="Laptop Acer" class="product-img">
                <h3 class="product-name">Laptop Acer Aspire</h3>
                <div class="product-price">
                    <span class="new-price">18.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
            <div class="product-card">
                <img src="<?= ASSET ?>assets/images/laptop1.png" alt="Laptop Acer" class="product-img">
                <h3 class="product-name">Laptop Acer Swift</h3>
                <div class="product-price">
                    <span class="new-price">21.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
        </div>
    </section>

    <!-- LAPTOP ASUS -->
    <section class="products-section">
        <div class="section-header">
            <h2 class="section-title">LAPTOP ASUS</h2>
        </div>
        <div class="products-grid">
            <div class="product-card">
                <img src="<?= ASSET ?>assets/images/laptop2.png" alt="Laptop Asus" class="product-img">
                <h3 class="product-name">Laptop Asus TUF Gaming</h3>
                <div class="product-price">
                    <span class="new-price">25.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
            <div class="product-card">
                <img src="<?= ASSET ?>assets/images/laptop3.png" alt="Laptop Asus" class="product-img">
                <h3 class="product-name">Laptop Asus ROG</h3>
                <div class="product-price">
                    <span class="new-price">42.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
            <div class="product-card">
                <img src="<?= ASSET ?>assets/images/laptop1.png" alt="Laptop Asus" class="product-img">
                <h3 class="product-name">Laptop Asus Zenbook</h3>
                <div class="product-price">
                    <span class="new-price">28.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
            <div class="product-card">
                <img src="<?= ASSET ?>assets/images/laptop2.png" alt="Laptop Asus" class="product-img">
                <h3 class="product-name">Laptop Asus VivoBook</h3>
                <div class="product-price">
                    <span class="new-price">19.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
        </div>
    </section>

    <!-- LAPTOP DELL -->
    <section class="products-section">
        <div class="section-header">
            <h2 class="section-title">LAPTOP DELL</h2>
        </div>
        <div class="products-grid">
            <div class="product-card">
                <img src="<?= ASSET ?>assets/images/laptop3.png" alt="Laptop Dell" class="product-img">
                <h3 class="product-name">Laptop Dell G15</h3>
                <div class="product-price">
                    <span class="new-price">27.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
            <div class="product-card">
                <img src="<?= ASSET ?>assets/images/laptop1.png" alt="Laptop Dell" class="product-img">
                <h3 class="product-name">Laptop Dell XPS</h3>
                <div class="product-price">
                    <span class="new-price">45.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
            <div class="product-card">
                <img src="<?= ASSET ?>assets/images/laptop2.png" alt="Laptop Dell" class="product-img">
                <h3 class="product-name">Laptop Dell Inspiron</h3>
                <div class="product-price">
                    <span class="new-price">22.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
            <div class="product-card">
                <img src="<?= ASSET ?>assets/images/laptop3.png" alt="Laptop Dell" class="product-img">
                <h3 class="product-name">Laptop Dell Alienware</h3>
                <div class="product-price">
                    <span class="new-price">55.990.000đ</span>
                </div>
                <button class="product-btn">Xem chi tiết</button>
            </div>
        </div>
    </section>

    <!-- TIN CÔNG NGHỆ -->
    <section class="news-section">
        <div class="section-header">
            <h2 class="section-title">TIN CÔNG NGHỆ</h2>
        </div>
        <div class="news-scroll">
            <div class="news-card">
                <img src="<?= ASSET ?>assets/images/laptop1.png" alt="Tech News" class="news-img">
                <p class="news-text">Vừa bán Hàng hiệu suất cao nhất 5.000 tỷ USD</p>
            </div>
            <div class="news-card">
                <img src="<?= ASSET ?>assets/images/laptop2.png" alt="Tech News" class="news-img">
                <p class="news-text">NVIDIA ra mắt GPU mới với hiệu năng vượt trội</p>
            </div>
            <div class="news-card">
                <img src="<?= ASSET ?>assets/images/laptop3.png" alt="Tech News" class="news-img">
                <p class="news-text">AMD Ryzen 9000 series chính thức lên kệ</p>
            </div>
            <div class="news-card">
                <img src="<?= ASSET ?>assets/images/laptop1.png" alt="Tech News" class="news-img">
                <p class="news-text">Windows 12 sẽ ra mắt vào năm 2025</p>
            </div>
        </div>
    </section>
</main>