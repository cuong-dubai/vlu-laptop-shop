<!-- Main Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 text-sm">
    <!-- Logo -->
    <a class="brand-link mt-2" href="index.php">
        <img src="./extensions/images/logo_head.png" alt="" style="max-width:150px">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview"
                role="menu" data-accordion="false">
                <!-- Bảng điều khiển -->
                <?php
                $active = "";
                if ($com == 'index' || $com == '')
                    $active = 'active';
                ?>
                <li class="nav-item <?= $active ?>">
                    <a class="nav-link <?= $active ?>" href="index.php" title="Bảng điều khiển">
                        <i class="nav-icon text-sm fas fa-tachometer-alt"></i>
                        <p>Bảng điều khiển</p>
                    </a>
                </li>
                <?php if (isset($config['product'])) { ?>
                    <?php foreach ($config['product'] as $k => $v) {
                        if (!isset($disabled['product'][$k])) { ?>
                            <?php
                            $none = "";
                            $active = "";
                            $menuopen = "menu-open";
                            if ((($com == 'product') || ($com == 'import') || ($com == 'export')) && ($k == $_GET['type'])) {
                                $active = 'active';
                                $menuopen = 'menu-open';
                            }
                            ?>
                            <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                                <a class="nav-link <?= $active ?>" href="#" title="Quản lý <?= $v['title_main'] ?>">
                                    <i class="nav-icon text-sm fas fa-boxes"></i>
                                    <p>
                                        Quản lý <?= $v['title_main'] ?>
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <?php if (!empty($v['dropdown'])) {
                                        if (isset($v['list']) && $v['list'] == true) {
                                            $none = "";
                                            $active = "";
                                            if ($com == 'product' && ($act == 'man_list' || $act == 'add_list' || $act == 'edit_list' || $kind == 'man_list') && $k == $_GET['type'])
                                                $active = "active"; ?>
                                            <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>"
                                                    href="index.php?com=product&act=man_list&type=<?= $k ?>" title="Danh mục sản phẩm"><i
                                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                                    <p>Danh mục sản phẩm</p>
                                                </a></li>
                                        <?php } ?>
                                        <?php if (isset($v['brand']) && $v['brand'] == true) {
                                            $none = "";
                                            $active = "";
                                            if ($com == 'product' && ($act == 'man_brand' || $act == 'add_brand' || $act == 'edit_brand') && $k == $_GET['type'])
                                                $active = "active"; ?>
                                            <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>"
                                                    href="index.php?com=product&act=man_brand&type=<?= $k ?>" title="Danh mục hãng"><i
                                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                                    <p>Danh mục hãng</p>
                                                </a></li>
                                        <?php } ?>

                                        <?php
                                        $none = "";
                                        $active = "";
                                        if ($com == 'product' && ($act == 'man' || $act == 'add' || $act == 'edit' || $act == 'copy' || $kind == 'man') && $k == $_GET['type'])
                                            $active = "active";
                                        ?>
                                        <li class="nav-item <?= $none ?>"><a class="nav-link <?= $active ?>"
                                                href="index.php?com=product&act=man&type=<?= $k ?>" title="<?= $v['title_main'] ?>"><i
                                                    class="nav-icon text-sm far fa-caret-square-right"></i>
                                                <p><?= $v['title_main'] ?></p>
                                            </a></li>
                                    <?php }
                        } ?>

                            </ul>
                        </li>
                    <?php }
                } ?>

                <!-- User -->
                <?php if (isset($config['user']['active']) && $config['user']['active'] == true) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "menu-open";
                    if ($com == 'user' && $act != 'login' && $act != 'logout') {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?= $menuopen ?> <?= $none ?>">
                        <a class="nav-link <?= $active ?>" href="#" title="Quản lý user">
                            <i class="nav-icon text-sm fas fa-users"></i>
                            <p>
                                Quản lý user
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (isset($config['permission']['active']) && $config['permission']['active'] == true) {
                                $active = "";
                                if ($act == 'permission_group' || $act == 'add_permission_group' || $act == 'edit_permission_group')
                                    $active = "active"; ?>
                                <li class="nav-item"><a class="nav-link <?= $active ?>"
                                        href="index.php?com=user&act=permission_group" title="Nhóm quyền"><i
                                            class="nav-icon text-sm far fa-caret-square-right"></i>
                                        <p>Nhóm quyền</p>
                                    </a></li>
                            <?php } ?>
                            <?php
                            $active = "";
                            if ($act == 'info_admin')
                                $active = "active";
                            ?>
                            <li class="nav-item"><a class="nav-link <?= $active ?>" href="index.php?com=user&act=info_admin"
                                    title="Thông tin admin"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p>Thông tin admin</p>
                                </a></li>
                            <?php if (isset($config['user']['admin']) && $config['user']['admin'] == true) {
                                $active = "";
                                if ($act == 'man_admin' || $act == 'add_admin' || $act == 'edit_admin')
                                    $active = "active"; ?>
                                <li class="nav-item"><a class="nav-link <?= $active ?>" href="index.php?com=user&act=man_admin"
                                        title="Tài khoản admin"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                        <p>Tài khoản admin</p>
                                    </a></li>
                            <?php } ?>
                            <?php if (isset($config['user']['member']) && $config['user']['member'] == true) {
                                $active = "";
                                if ($com == 'user' && ($act == 'man_member' || $act == 'add_member' || $act == 'edit_member'))
                                    $active = "active"; ?>
                                <li class="nav-item"><a class="nav-link <?= $active ?>" href="index.php?com=user&act=man_member"
                                        title="Tài khoản khách"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                        <p>Tài khoản khách</p>
                                    </a></li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <!-- News -->
                <?php
                $none = "";
                $active = "";
                if ($com == 'news') {
                    $active = 'active';
                }
                ?>
                <li class="nav-item <?= $active ?>">
                    <a class="nav-link <?= $active ?>" href="index.php?com=news&act=man" title="Quản lý tin tức">
                        <i class="nav-icon text-sm fas fa-newspaper"></i>
                        <p>Quản lý tin tức</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>