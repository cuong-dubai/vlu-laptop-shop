-- Tạo bảng news cho hệ thống tin tức/bài viết
-- Chạy file này trong phpMyAdmin hoặc MySQL client

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `desc` mediumtext DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `numb` int(11) DEFAULT 0,
  `status` varchar(255) DEFAULT NULL,
  `type` varchar(30) DEFAULT 'tin-tuc',
  `date_created` int(11) DEFAULT 0,
  `date_updated` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

