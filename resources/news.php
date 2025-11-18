<?php
if (!defined('SOURCES')) {
    die("Error");
}

$newsModel = new News($d);
$newsDetail = null;
if (!empty($_GET['id'])) {
    $slug = htmlspecialchars($_GET['id']);
    
    $d->where('id', $slug);
    $newsDetail = $d->getOne('news');
    
    if ($newsDetail) {
        $titleMain = $newsDetail['name'] ?? 'Chi tiết tin tức';
    } else {
        $newsDetail = null;
    }
} else {
    // Hiển thị danh sách tin tức
    $allNews = $newsModel->readAll();
}

