-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 17, 2025 lúc 10:09 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vlu_laptop_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `desc` mediumtext DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `numb` int(11) DEFAULT 0,
  `status` varchar(255) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `date_created` int(11) DEFAULT 0,
  `date_updated` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brand`
--

INSERT INTO `brand` (`id`, `slug`, `content`, `desc`, `name`, `photo`, `numb`, `status`, `type`, `date_created`, `date_updated`) VALUES
(1, 'asus', NULL, NULL, 'asus', NULL, 1, 'hienthi', 'san-pham', 1763255513, 1763255542),
(2, 'acer', NULL, NULL, 'acer', NULL, 1, 'hienthi', 'san-pham', 1763255524, 1763255538),
(3, 'dell', NULL, NULL, 'dell', NULL, 1, 'hienthi', 'san-pham', 1763255530, 1763255546),
(4, 'hp', NULL, NULL, 'hp', NULL, 1, 'hienthi', 'san-pham', 1763255552, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `desc` mediumtext DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `numb` int(11) DEFAULT 0,
  `status` varchar(255) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `date_created` int(11) DEFAULT 0,
  `date_updated` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `slug`, `content`, `desc`, `name`, `photo`, `numb`, `status`, `type`, `date_created`, `date_updated`) VALUES
(2, 'laptop-gamming', NULL, NULL, 'Laptop Gamming', NULL, 1, 'noibat,hienthi', 'san-pham', 1763128862, 1763128883),
(3, 'laptop-van-ph', NULL, NULL, 'Laptop Văn Phòng', NULL, 1, 'noibat,hienthi', 'san-pham', 1763128876, 0),
(4, 'laptop-gia-re', NULL, NULL, 'Laptop Giá Rẻ', NULL, 1, 'hienthi', 'san-pham', 1763128896, 1763128930),
(6, 'laptop-cu', NULL, NULL, 'Laptop Cũ', NULL, 1, 'hienthi', 'san-pham', 1763362915, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_price` double DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `date_created` int(11) DEFAULT 0,
  `date_updated` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `customer_name`, `phone`, `address`, `total_price`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Nguyễn Văn Test', '0901234567', '123 Đường Test, Quận 1', 97000000, 1, 1763362026, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_order` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `price` double DEFAULT 0,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`id`, `id_order`, `id_product`, `price`, `quantity`) VALUES
(1, 1, 15, 19500000, 2),
(2, 1, 17, 29000000, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_list` int(11) DEFAULT NULL,
  `id_brand` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `desc` mediumtext DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `regular_price` double DEFAULT 0,
  `discount` double DEFAULT 0,
  `sale_price` double DEFAULT 0,
  `numb` int(11) DEFAULT 0,
  `status` varchar(255) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `date_created` int(11) DEFAULT 0,
  `date_updated` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `id_list`, `id_brand`, `photo`, `slug`, `content`, `desc`, `name`, `code`, `regular_price`, `discount`, `sale_price`, `numb`, `status`, `type`, `date_created`, `date_updated`) VALUES
(13, 3, 4, 'image-2420.png', 'laptop-hp-omen-16-am0127tx', 'Update nội dung sản phẩm\r\n', 'Update sản phẩm\r\n', 'Laptop HP Omen 16-am0127TX ', NULL, 15000000, 10, 13500000, 1, 'hienthi', 'san-pham', 1763126833, 1763256945),
(14, 2, 4, 'image-7560.png', 'laptop-hp-omen-16-am0127tx-2', NULL, NULL, 'Laptop HP Omen 16-am0127TX 2', NULL, 20000000, 10, 18000000, 1, 'hienthi', 'san-pham', 1763258616, 0),
(15, 3, 2, 'image2-6185.png', 'laptop-acer-swift-go-14-sfg14-41-r251', NULL, NULL, 'Laptop Acer Swift Go 14 SFG14-41-R251', NULL, 20000000, 3, 19500000, 1, 'hienthi', 'san-pham', 1763258778, 0),
(16, 3, 2, 'image-6568.png', 'laptop-acer-swift-go-14-sfg14-41-r252', NULL, NULL, 'Laptop Acer Swift Go 14 SFG14-41-R252', NULL, 15400000, 3, 14900000, 1, 'hienthi', 'san-pham', 1763258823, 0),
(17, 2, 3, 'image-1-8322.png', 'laptop-dell-inspiron-5440-g14', NULL, NULL, 'Laptop Dell Inspiron 5440 G14', NULL, 35000000, 17, 29000000, 1, 'hienthi', 'san-pham', 1763297657, 0),
(19, 2, 3, 'image-2-9538.png', 'laptop-dell-inspiron-5440-g13', NULL, NULL, 'Laptop Dell Inspiron 5440 G13', NULL, 15050000, 0, 14500000, 1, 'hienthi', 'san-pham', 1763297724, 0),
(20, 2, 3, 'image-3-5031.png', 'laptop-dell-inspiron-5440-g12', NULL, NULL, 'Laptop Dell Inspiron 5440 G12', NULL, 26000000, 8, 24000000, 1, 'hienthi', 'san-pham', 1763297772, 0),
(21, 4, 3, 'image-4-7368.png', 'laptop-dell-inspiron-5440-g11', NULL, NULL, 'Laptop Dell Inspiron 5440 G11', NULL, 0, 0, 0, 1, 'hienthi', 'san-pham', 1763297807, 0),
(22, 4, 3, 'image-1-1424.png', 'laptop-dell-inspiron-5440-g09', NULL, NULL, 'Laptop Dell Inspiron 5440 G09', NULL, 12000000, 8, 11000000, 1, 'hienthi', 'san-pham', 1763297894, 0),
(23, 4, 2, 'image-4-6893.png', 'laptop-acer-swift-go-14-sfg14-41-r209', NULL, NULL, 'Laptop Acer Swift Go 14 SFG14-41-R209', NULL, 9000000, 1, 8900000, 1, 'hienthi', 'san-pham', 1763297955, 0),
(24, 4, 4, 'image-2-7728.png', 'laptop-acer-swift-go-14-sfg14-41-ies09', NULL, NULL, 'Laptop Acer Swift Go 14 SFG14-41-IES09', NULL, 11000000, 9, 10000000, 1, 'hienthi', 'san-pham', 1763298024, 0),
(25, 3, 2, 'image-3-8487.png', 'laptop-acer-swift-go-14-sfg14-41-o321', NULL, NULL, 'Laptop Acer Swift Go 14 SFG14-41-O321', NULL, 16000000, 6, 15000000, 1, 'hienthi', 'san-pham', 1763298088, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_permission` int(11) DEFAULT 0,
  `username` varchar(225) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `confirm_code` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `fullname` varchar(225) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT 0,
  `login_session` varchar(255) DEFAULT NULL,
  `user_token` varchar(255) DEFAULT NULL,
  `lastlogin` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `role` tinyint(1) DEFAULT 1,
  `secret_key` varchar(255) DEFAULT NULL,
  `birthday` int(11) DEFAULT 0,
  `numb` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `id_permission`, `username`, `password`, `confirm_code`, `avatar`, `fullname`, `phone`, `email`, `address`, `gender`, `login_session`, `user_token`, `lastlogin`, `status`, `role`, `secret_key`, `birthday`, `numb`) VALUES
(1, 0, 'admin', '568a8135a10e8d89e74eded32fd10acf', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'r5txJHkKFCTkoc9Cwp9L2VbJrNWzfgD3', 'IUr5RRWenFSuIBUrmi7i9ZcHtH88pX0H', '1763369544', 'hienthi', 1, 'fcbd8425de65b190febd78fa3e65b6cb', 0, 0),
(2, 0, 'nhathuy', 'bfd05e70286fd2d16ce459101c63ec5a', NULL, NULL, 'huy', '0369819251', 'huynhat870@gmail.com', NULL, 1, '4948299867eca6ae58c2aeab86ce138f', 'c37a538434dbfb772aaab1ef00fc3df1', '1763365552', 'hienthi', 0, NULL, 0, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_detail_order` (`id_order`),
  ADD KEY `fk_order_detail_product` (`id_product`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_category` (`id_list`),
  ADD KEY `fk_product_brand` (`id_brand`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_order_detail_order` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_order_detail_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_brand` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`id_list`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
