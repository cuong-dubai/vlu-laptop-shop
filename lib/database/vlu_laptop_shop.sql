-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2025 at 11:02 AM
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
-- Database: `vlu_laptop_shop`
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
(4, 'laptop-gia-re', NULL, NULL, 'Laptop Giá Rẻ', NULL, 1, 'hienthi', 'san-pham', 1763128896, 1763128930);

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
(16, 3, 2, 'image-6568.png', 'laptop-acer-swift-go-14-sfg14-41-r252', NULL, NULL, 'Laptop Acer Swift Go 14 SFG14-41-R252', NULL, 15400000, 3, 14900000, 1, 'hienthi', 'san-pham', 1763258823, 0);

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
(1, 0, 'admin', 'c0c68ae362117b07fae961c8023d2c7a', NULL, NULL, NULL, NULL, NULL, NULL, 0, '1ea1cca2a8ade4408303119eb2b2ebce', '2940c1a41aa68e49ffdb36138886bea0', '1763259354', 'hienthi', 1, '1ea1cca2a8ade4408303119eb2b2ebce', 0, 0);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

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
