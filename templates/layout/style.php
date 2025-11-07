/* style.css - Pure CSS */

@charset "UTF-8";

/* ==================================== */
/* CẤU HÌNH CHUNG & CONTAINER */
/* ==================================== */

/* Mô phỏng container mx-auto của Tailwind */
.container {
    max-width: 1280px; /* Tùy chỉnh theo thiết kế */
    width: 90%;
    margin-left: auto;
    margin-right: auto;
}

/* Các lớp hỗ trợ (để giữ cho code HTML đơn giản) */
.mr-1 { margin-right: 0.25rem; } /* 4px */
.mt-1 { margin-top: 0.25rem; }
.text-sm { font-size: 0.875rem; } /* 14px */
.font-bold { font-weight: 700; }
.text-red-600 { color: #dc2626; } /* Màu đỏ tiêu chuẩn */
.text-gray-700 { color: #374151; }
.text-white { color: white; }
.text-black { color: black; }
.bg-black { background-color: black; }
.bg-gray-200 { background-color: #e5e7eb; }
.bg-white { background-color: white; }


/* ==================================== */
/* HEADER & NAVIGATION */
/* ==================================== */

/* Thanh Top Bar */
.top-bar {
    /* Thay thế cho bg-black text-white text-center py-2 text-sm */
    background-color: black;
    color: white;
    text-align: center;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    font-size: 0.875rem;
}

/* Header Chính (Logo, Search, Utilities) */
.header-main {
    /* Thay thế cho flex items-center justify-between py-4 */
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 1rem;
    padding-bottom: 1rem;
}

.header-logo {
    /* Thay thế cho flex flex-col items-center */
    display: flex;
    flex-direction: column;
    align-items: center;
}

.logo-img {
    /* Thay thế cho w-12 h-12 */
    width: 3rem;  /* 48px */
    height: 3rem; /* 48px */
}

/* Thanh tìm kiếm */
.search-container {
    /* Thay thế cho relative flex items-center w-full max-w-lg mx-8 */
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 36rem; /* Giả định max-w-lg */
    margin-left: 2rem;
    margin-right: 2rem;
}

.search-input {
    /* Thay thế cho w-full px-4 py-2 pr-10 rounded-md border... */
    width: 100%;
    padding: 0.5rem 2.5rem 0.5rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    background-color: #f3f4f6;
    outline: none;
}

.search-btn {
    /* Thay thế cho absolute right-0 top-1/2 transform -translate-y-1/2 */
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    padding: 0.5rem;
    cursor: pointer;
    background: none;
    border: none;
}

/* Các nút tiện ích */
.header-utilities {
    /* Thay thế cho flex items-center space-x-4 */
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 0.875rem;
    color: #374151;
}

.utility-item {
    display: flex;
    align-items: center;
    cursor: pointer;
    background: none;
    border: none;
    font-size: 0.875rem;
    color: inherit;
    padding: 0;
}

.utility-item:hover,
.nav-link:hover {
    color: black;
}

/* Menu Điều hướng */
.nav-menu {
    /* Thay thế cho border-y border-gray-200 bg-white */
    border-top: 1px solid #e5e7eb;
    border-bottom: 1px solid #e5e7eb;
    background-color: white;
}

.nav-content {
    /* Thay thế cho flex items-center justify-between h-10 text-sm font-semibold */
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 2.5rem;
    font-size: 0.875rem;
    font-weight: 600;
}

.nav-category-btn {
    /* Thay thế cho flex items-center h-full px-4 bg-gray-200 */
    display: flex;
    align-items: center;
    height: 100%;
    padding-left: 1rem;
    padding-right: 1rem;
    background-color: #e5e7eb;
    color: #374151;
    cursor: pointer;
    border: none;
    font-size: inherit;
    font-weight: inherit;
}

.nav-links {
    /* Thay thế cho flex space-x-8 */
    display: flex;
    gap: 2rem;
    color: #374151;
}

.nav-cart-btn {
    /* Thay thế cho flex items-center text-red-600 font-bold px-4 */
    display: flex;
    align-items: center;
    color: #dc2626;
    font-weight: 700;
    padding-left: 1rem;
    padding-right: 1rem;
    background: none;
    border: none;
    cursor: pointer;
    font-size: inherit;
}

/* ==================================== */
/* MAIN CONTENT & BANNERS */
/* ==================================== */

.main-content {
    padding-top: 1rem;
}

.main-grid {
    /* Thay thế cho grid grid-cols-3 gap-4 */
    display: grid;
    /* Chia lưới 3 cột, với cột lớn chiếm 2 phần và cột nhỏ chiếm 1 phần */
    grid-template-columns: 2fr 1fr; 
    gap: 1rem; /* Khoảng cách giữa các phần tử */
}

/* Banner Lớn */
.banner-large {
    /* Thay thế cho col-span-2 relative h-[450px] overflow-hidden rounded-lg shadow-lg */
    position: relative;
    height: 450px;
    overflow: hidden;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
}

.banner-img {
    /* Thay thế cho w-full h-full object-cover */
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.main-banner-overlay {
    /* Thay thế cho absolute bottom-0 left-0 p-10 */
    position: absolute;
    bottom: 0;
    left: 0;
    padding: 2.5rem;
}

.shop-btn {
    /* Thay thế cho w-40 py-3 bg-yellow-400 text-black font-extrabold rounded-md shadow-2xl */
    width: 10rem; /* w-40 */
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
    background-color: #facc15; /* yellow-400 */
    color: black;
    font-weight: 800;
    border-radius: 0.375rem;
    border: none;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    cursor: pointer;
    transition: background-color 0.3s;
}

.shop-btn:hover {
    background-color: #eab308; /* yellow-500 */
}

.promo-text {
    /* Thay thế cho absolute bottom-5 right-5 text-white text-sm font-semibold text-right */
    position: absolute;
    bottom: 1.25rem;
    right: 1.25rem;
    color: white;
    font-size: 0.875rem;
    font-weight: 600;
    text-align: right;
}

/* Ba Banner Nhỏ */
.side-banners {
    /* Thay thế cho col-span-1 flex flex-col space-y-2 */
    display: flex;
    flex-direction: column;
    gap: 0.5rem; /* Khoảng cách 8px */
}

.banner-small {
    /* Thay thế cho relative h-[146px] overflow-hidden rounded-lg shadow-md */
    position: relative;
    height: 146px;
    overflow: hidden;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
}

/* ==================================== */
/* FOOTER */
/* ==================================== */

.site-footer {
    background-color: white;
    margin-top: 3rem;
}

.footer-main {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    padding: 3rem 0;
    border-top: 1px solid #e5e7eb;
}

.footer-section {
    display: flex;
    flex-direction: column;
}

.footer-title {
    font-size: 1rem;
    font-weight: 700;
    color: #374151;
    margin-bottom: 1.5rem;
    text-transform: uppercase;
}

.footer-info {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    font-size: 0.875rem;
    color: #374151;
    line-height: 1.5;
}

.info-icon {
    flex-shrink: 0;
    margin-top: 0.125rem;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.footer-links li a {
    color: #374151;
    text-decoration: none;
    font-size: 0.875rem;
    transition: color 0.2s;
}

.footer-links li a:hover {
    color: #dc2626;
}

.footer-description {
    font-size: 0.875rem;
    color: #374151;
    margin-bottom: 1rem;
    line-height: 1.5;
}

.newsletter-form {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
}

.newsletter-input {
    flex: 1;
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    background-color: #f3f4f6;
    font-size: 0.875rem;
    outline: none;
}

.newsletter-input:focus {
    border-color: #dc2626;
    background-color: white;
}

.newsletter-btn {
    width: 3rem;
    height: 3rem;
    background-color: #dc2626;
    border: none;
    border-radius: 50%;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.2s;
    flex-shrink: 0;
}

.newsletter-btn:hover {
    background-color: #b91c1c;
}

.social-icons {
    display: flex;
    gap: 0.75rem;
}

.social-icon {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    background-color: #f3f4f6;
    color: #374151;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.2s;
}

.social-icon:hover {
    background-color: #dc2626;
    color: white;
}

.footer-bottom {
    background-color: #374151;
    color: white;
    padding: 1rem 0;
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.875rem;
}

.footer-bottom-links {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.footer-bottom-links a {
    color: white;
    text-decoration: none;
    transition: color 0.2s;
}

.footer-bottom-links a:hover {
    color: #dc2626;
}

.separator {
    color: #6b7280;
}

.w-clear {
    clear: both;
}

@media only screen and (max-width: 768px) {
    .main-grid {
        grid-template-columns: 1fr;
    }
    
    .header-main {
        flex-direction: column;
        gap: 1rem;
    }
    
    .search-container {
        margin-left: 0;
        margin-right: 0;
    }
    
    .nav-content {
        flex-wrap: wrap;
    }
    
    .nav-links {
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .footer-main {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .footer-bottom-content {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
}