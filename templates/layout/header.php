<?php 
// 1. Thanh Thông Báo (Top Bar)
?>
<div class="top-bar">
  {"Select in the calendar on the right hand side convenient for you the day and time and call yourself a free specialist."}
</div>

<?php
// 2. Header Chính (Logo, Tìm kiếm, Tiện ích)
?>
<header class="header-main container">
    <div class="header-logo">
        <img src="<?= ASSET ?>assets/images/logo.jpg" alt="VLU Laptop Shop Logo" class="logo-img"> 
        <span class="logo-text">VLU LAPTOP SHOP</span>
    </div>

    <div class="search-container">
        <input type="text" placeholder="Tìm kiếm..." class="search-input">
        <button class="search-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        </button>
    </div>

    <div class="header-utilities">
        <button class="utility-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text mr-1"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            Tra Cứu Đơn Hàng
        </button>
        <button class="utility-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user mr-1"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Đăng Nhập
        </button>
        <button class="utility-item cart-header-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart mr-1"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.6 12.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 1.8-1.5L22 6H5"/></svg>
            GIỎ HÀNG (0)
        </button>
    </div>
</header>

<?php
// 3. Thanh Điều Hướng Menu Phụ
?>
<nav class="nav-menu">
    <div class="nav-content container">
        <button class="nav-category-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu mr-2"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
            DANH MỤC SẢN PHẨM
        </button>
        
        <div class="nav-links">
            <a href="#" class="nav-link">TRANG CHỦ</a>
            <a href="#" class="nav-link">GIỚI THIỆU</a>
            <a href="#" class="nav-link">TIN TỨC</a>
            <a href="#" class="nav-link">LIÊN HỆ</a>
        </div>
        
        <button class="nav-cart-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart mr-1"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.6 12.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 1.8-1.5L22 6H5"/></svg>
            GIỎ HÀNG (0)
        </button>
    </div>
</nav>