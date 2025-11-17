<script type="text/javascript">
    var VLU = VLU || {};
</script>

<?php 
    $js->set("js/jquery.min.js");
    $js->set("bootstrap/bootstrap.js");
    $js->set("slick/slick.js");
    $js->set("js/app.js");
    echo $js -> get();
?>