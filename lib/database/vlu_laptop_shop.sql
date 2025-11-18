-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2025 at 01:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vlu_laptop_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
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
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `slug`, `content`, `desc`, `name`, `photo`, `numb`, `status`, `type`, `date_created`, `date_updated`) VALUES
(1, 'asus', NULL, NULL, 'asus', NULL, 1, 'hienthi', 'san-pham', 1763255513, 1763255542),
(2, 'acer', NULL, NULL, 'acer', NULL, 1, 'hienthi', 'san-pham', 1763255524, 1763255538),
(3, 'dell', NULL, NULL, 'dell', NULL, 1, 'hienthi', 'san-pham', 1763255530, 1763255546),
(4, 'hp', NULL, NULL, 'hp', NULL, 1, 'hienthi', 'san-pham', 1763255552, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
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
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `content`, `desc`, `name`, `photo`, `numb`, `status`, `type`, `date_created`, `date_updated`) VALUES
(2, 'laptop-gamming', NULL, NULL, 'Laptop Gamming', NULL, 1, 'noibat,hienthi', 'san-pham', 1763128862, 1763128883),
(3, 'laptop-van-ph', NULL, NULL, 'Laptop Văn Phòng', NULL, 1, 'noibat,hienthi', 'san-pham', 1763128876, 0),
(4, 'laptop-gia-re', NULL, NULL, 'Laptop Giá Rẻ', NULL, 1, 'hienthi', 'san-pham', 1763128896, 1763128930);

-- --------------------------------------------------------

--
-- Table structure for table `product`
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
-- Dumping data for table `product`
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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `note` mediumtext DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT 'cod',
  `shipping_method` varchar(50) DEFAULT 'standard',
  `total_qty` int(11) DEFAULT 0,
  `total_price` double DEFAULT 0,
  `status` varchar(50) DEFAULT 'pending',
  `date_created` int(11) DEFAULT 0,
  `date_updated` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_slug` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `price` double DEFAULT 0,
  `qty` int(11) DEFAULT 0,
  `total_price` double DEFAULT 0,
  `date_created` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_permission`, `username`, `password`, `confirm_code`, `avatar`, `fullname`, `phone`, `email`, `address`, `gender`, `login_session`, `user_token`, `lastlogin`, `status`, `role`, `secret_key`, `birthday`, `numb`) VALUES
(1, 0, 'admin', 'c0c68ae362117b07fae961c8023d2c7a', NULL, NULL, NULL, NULL, NULL, NULL, 0, '1ea1cca2a8ade4408303119eb2b2ebce', '35832ba98fcf2b39553a0c6d4da9ab76', '1763339776', 'hienthi', 1, '1ea1cca2a8ade4408303119eb2b2ebce', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_category` (`id_list`),
  ADD KEY `fk_product_brand` (`id_brand`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_brand` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`id_list`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_order_detail_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_detail_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
