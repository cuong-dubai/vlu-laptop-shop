-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 18, 2025 at 08:58 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vlu-laptop-shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci,
  `desc` mediumtext COLLATE utf8mb4_unicode_ci,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numb` int DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` int DEFAULT '0',
  `date_updated` int DEFAULT '0'
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
  `id` int NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci,
  `desc` mediumtext COLLATE utf8mb4_unicode_ci,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numb` int DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` int DEFAULT '0',
  `date_updated` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `content`, `desc`, `name`, `photo`, `numb`, `status`, `type`, `date_created`, `date_updated`) VALUES
(2, 'laptop-gamming', NULL, NULL, 'Laptop Gamming', NULL, 1, 'noibat,hienthi', 'san-pham', 1763128862, 1763128883),
(3, 'laptop-van-ph', NULL, NULL, 'Laptop Văn Phòng', NULL, 1, 'noibat,hienthi', 'san-pham', 1763128876, 0),
(4, 'laptop-gia-re', NULL, NULL, 'Laptop Giá Rẻ', NULL, 1, 'hienthi', 'san-pham', 1763128896, 1763128930),
(5, 'laptop-cu', NULL, NULL, 'Laptop Cũ', NULL, 1, '', 'san-pham', 1763443314, 1763454160);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '0',
  `login_session` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastlogin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` int DEFAULT '0',
  `numb` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `password`, `avatar`, `fullname`, `phone`, `email`, `address`, `gender`, `login_session`, `lastlogin`, `status`, `birthday`, `numb`) VALUES
(2, 'cuongpro', '4297f44b13955235245b2497399d7a93', NULL, 'CUONG PHAN', '0382915164', 'minhcuongdev.vndts@gmail.com', NULL, 1, 'ce73dc2c4c7af22f715c7ef1b38e6025', '1763341982', 'hienthi', 0, 0),
(4, 'nhathuy', '6acc425067c38744abeed172802af91a', NULL, 'nhathuy', '0369819251', 'kimphung7a3@gmail.cm', NULL, 1, 'b3414f442e328dec26cdec56f6f315f1', '1763445824', 'hienthi', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` mediumtext COLLATE utf8mb4_unicode_ci,
  `content` mediumtext COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numb` int DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT 'tin-tuc',
  `date_created` int DEFAULT '0',
  `date_updated` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `slug`, `name`, `desc`, `content`, `photo`, `numb`, `status`, `type`, `date_created`, `date_updated`) VALUES
(1, 'acsca', 'Tin tức công nghệ mới', 'câcscá', 'câcsca', 'slide-hop-giay-2892.webp', 1, 'hienthi', 'tin-tuc', 1763453571, 1763455405);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int NOT NULL,
  `order_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci,
  `total_price` double DEFAULT '0',
  `status` int DEFAULT '1',
  `date_created` int DEFAULT '0',
  `date_updated` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int NOT NULL,
  `id_order` int NOT NULL,
  `id_product` int NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT '0',
  `quantity` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int UNSIGNED NOT NULL,
  `id_list` int DEFAULT NULL,
  `id_brand` int DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci,
  `desc` mediumtext COLLATE utf8mb4_unicode_ci,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regular_price` double DEFAULT '0',
  `discount` double DEFAULT '0',
  `sale_price` double DEFAULT '0',
  `numb` int DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_created` int DEFAULT '0',
  `date_updated` int DEFAULT '0'
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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL,
  `id_permission` int DEFAULT '0',
  `username` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirm_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '0',
  `login_session` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastlogin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint(1) DEFAULT '1',
  `secret_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` int DEFAULT '0',
  `numb` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_permission`, `username`, `password`, `confirm_code`, `avatar`, `fullname`, `phone`, `email`, `address`, `gender`, `login_session`, `user_token`, `lastlogin`, `status`, `role`, `secret_key`, `birthday`, `numb`) VALUES
(1, 0, 'admin', 'c0c68ae362117b07fae961c8023d2c7a', NULL, NULL, NULL, NULL, NULL, NULL, 0, '1ea1cca2a8ade4408303119eb2b2ebce', '284d7f83acb35e61a013dc4c675e03c9', '1763455803', 'hienthi', 1, '1ea1cca2a8ade4408303119eb2b2ebce', 0, 0);

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
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_category` (`id_list`),
  ADD KEY `fk_product_brand` (`id_brand`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_brand` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`id_list`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
