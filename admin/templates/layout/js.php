<!-- Js Config -->
<script type="text/javascript">
    var PHP_VERSION = parseFloat('<?= phpversion() ?>'.replaceAll('.', ','));
    var CONFIG_BASE = '<?= $configBase ?>';
    var TOKEN = '<?= TOKEN ?>';
    var ADMIN = '<?= ADMIN ?>';
    var ASSET = '<?= ASSET ?>';
    var LINK_FILTER = '<?= (!empty($linkFilter)) ? $linkFilter : '' ?>';
    var ID = <?= (!empty($id)) ? $id : 0 ?>;
    var COM = '<?= (!empty($com)) ? $com : '' ?>';
    var ACT = '<?= (!empty($act)) ? $act : '' ?>';
    var TYPE = '<?= (!empty($type)) ? $type : '' ?>';
    var HASH = '<?= $func->generateHash() ?>';
    var ACTIVE_GALLERY = <?= (!empty($flagGallery) && !empty($gallery)) ? 'true' : 'false' ?>;
    var BASE64_QUERY_STRING = '<?= base64_encode($_SERVER['QUERY_STRING']) ?>';
    var LOGIN_PAGE = <?= (empty($_SESSION[$loginAdmin]['active'])) ? 'true' : 'false' ?>;
</script>
<script src="extensions/js/jquery.min.js"></script>
<script src="extensions/js/bootstrap.js"></script>
<script src="extensions/confirm/confirm.js"></script>
<script src="extensions/js/default.js"></script>
<script src="extensions/js/priceFormat.js"></script>
<script src="extensions/js/app.js"></script>