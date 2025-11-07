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
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck-delivery mr-1"><path d="M5 21V3"/><path d="M10 21V8"/><path d="M15 21V3"/><path d="M19 19H5"/><path d="M4 19h16"/></svg>
            Tra Cứu Đơn Hàng
        </button>
        <button class="utility-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user mr-1"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Đăng Nhập
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