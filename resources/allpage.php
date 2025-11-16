<?php
    $categoriesMenu = $d->rawQuery("select * from #_categories where type = ? and find_in_set('hienthi',status) order by numb,id desc",array('san-pham'));
?>
