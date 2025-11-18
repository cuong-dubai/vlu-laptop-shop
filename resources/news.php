<?php
if (!defined('SOURCES')) {
    die("Error");
}

$newsModel = new News($d);
$newsDetail = null;

// Kiểm tra nếu có slug trong URL (xem chi tiết bài viết)
if (!empty($_GET['slug'])) {
    $slug = htmlspecialchars($_GET['slug']);
    
    // Tìm bài viết theo slug
    $d->where('slug', $slug);
    $newsDetail = $d->getOne('news');
    
    if ($newsDetail) {
        $titleMain = $newsDetail['name'] ?? 'Chi tiết tin tức';
    } else {
        // Không tìm thấy bài viết
        $newsDetail = null;
    }
} else {
    // Hiển thị danh sách tin tức
    $allNews = $newsModel->readAll();
}

