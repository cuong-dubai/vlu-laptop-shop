<?php
    /* Sản phẩm bán chạy */
    $productBestSeller = $d->rawQuery("select * from #_product where type = ? and find_in_set('hienthi',status) order by numb,id desc limit 0,8",array('san-pham'));

    $categories = $d->rawQuery("select * from #_categories where type = ? and find_in_set('hienthi',status) order by numb,id desc",array('san-pham'));

    /* Tin tức mới nhất */
    $newsModel = new News($d);
    $latestNews = $newsModel->readAll(4);
    
?>
