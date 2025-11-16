<?php
    /* Sản phẩm bán chạy */
    $productBestSeller = $d->rawQuery("select * from #_product where type = ? and find_in_set('hienthi',status) order by numb,id desc",array('san-pham'));

    
?>
