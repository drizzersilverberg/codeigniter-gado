<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-code"></i>
            </div>
            <div class="sidebar-brand-text mx-3">CI Gado <sup>3</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Query Menu -->
        <?php
        $role_id = $this->session->userdata('role_id');
        $queryMenu = "
                        SELECT `menu`.`id` , `menu`
                        FROM `menu` 
                        JOIN `access_menu` ON `menu`.`id` = `access_menu`.`menu_id`
                        WHERE `access_menu`.`role_id` = $role_id
                        ORDER BY `access_menu`.`menu_id` ASC
                    ";
        $menu = $this->db->query($queryMenu)->result_array();

        ?>

        <?php foreach ($menu as $m) : ?>
            <div class="sidebar-heading">
                <?= $m['menu']; ?>
            </div>

            <?php
            $menuId = $m['id'];
            $querySubmenu = "
                    SELECT *
                    FROM `sub_menu`
                    JOIN `menu` ON `sub_menu`.`menu_id` = `menu`.`id`
                    WHERE `sub_menu`.`menu_id` = $menuId
                    AND `sub_menu`.`is_active` = 1
                ";

            $subMenu = $this->db->query($querySubmenu)->result_array();

            // var_dump($subMenu);
            // die;
            ?>

            <?php foreach ($subMenu as $sm) : ?>
                <li class="nav-item <?php if ($sm['title'] == $title) echo 'active'; ?>">
                    <a href="<?= base_url($sm['url']); ?>" class="nav-link">
                        <i class="<?= $sm['icon']; ?>"></i>
                        <span><?= $sm['title']; ?></span>
                    </a>
                </li>
            <?php endforeach; ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

        <?php endforeach; ?>


        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-3 d-none d-lg-inline text-gray-600 small"><?= $user['name'] ?? '' ?></span>
                            <img class="img-profile rounded-circle" src="<?= base_url('assets/sbadmin/img/profile/' . ($user['image'] ?? 'default.png')); ?>">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                My Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->