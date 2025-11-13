-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 13, 2025 at 02:29 AM
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
(1, 0, 'admin', 'c0c68ae362117b07fae961c8023d2c7a', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'hienthi', 1, NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
