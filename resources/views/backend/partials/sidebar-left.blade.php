<section class="sidebar">
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <?php
        $__sidebar = array(
                array(
                        'title'  => 'Dashboard',
                        'icon'   => 'fa-dashboard',
                        'route'  => 'backend.dashboard.index',
                        'active' => '/',
                ),
                array(
                        'title'  => 'Tài khoản',
                        'icon'   => 'fa-user',
                        'active' => 'user*',
                        'sub'    => array(
                                array(
                                        'title' => 'Danh sách',
                                        'route' => 'backend.users.index'
                                ),
                                array(
                                        'title' => 'Thêm mới',
                                        'route' => 'backend.users.create',
                                ),
                        )
                ),
                array(
                        'title'  => 'Danh mục',
                        'icon'   => 'fa-tasks',
                        'active' => 'categories*',
                        'sub'    => array(
                                array(
                                        'title' => 'Danh sách',
                                        'route' => 'backend.categories.index'
                                ),
                                array(
                                        'title' => 'Thêm mới',
                                        'route' => 'backend.categories.create',
                                ),
                        )
                ),
                array(
                        'title'  => 'Phân quyền',
                        'icon'   => 'fa-cogs',
                        'active' => 'group*',
                        'sub'    => array(
                                array(
                                        'title' => 'Danh sách',
                                        'route' => 'backend.groups.index'
                                ),
                                array(
                                        'title' => 'Thêm mới',
                                        'route' => 'backend.groups.create',
                                )
                        )
                ),

        );
        foreach ($__sidebar as $__s) {
            echo createSideBackend($__s);
        }
        ?>
    </ul>
</section>