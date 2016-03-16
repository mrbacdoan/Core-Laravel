<?php

return array(
    array(
        'text'    => 'Menu Navigation',
        'heading' => true,
    ),
    array(
        'text' => 'Dashboard',
        'sref' => 'app.dashboard',
        'icon' => 'icon-speedometer',
    ),
    array(
        'text'    => 'Bài viết',
        'icon'    => 'fa fa-book',
        'submenu' => [
            [
                'sref' => 'app.posts-index',
                'text' => 'Danh sách bài viết',
            ],
            [
                'sref' => 'app.posts-create',
                'text' => 'Viết bài mới',
            ],
        ],
    ),
    array(
        'text'    => 'Album ảnh',
        'icon'    => 'icon-picture',
        'submenu' => [
            [
                'sref' => 'app.photos-index',
                'text' => 'Danh sách album',
            ],
            [
                'sref'   => 'app.photos-create',
                'params' => ['id' => ''],
                'text'   => 'Thêm album',
            ],
        ],
    ),
    array(
        'text'    => 'Videos',
        'icon'    => 'icon-camrecorder icon-camcorder',
        'submenu' => [
            [
                'sref' => 'app.medias-index',
                'text' => 'Danh sách Media',
            ],
            [
                'sref' => 'app.medias-create',
                'text' => 'Thêm media',
            ],
        ],
    ),
    array(
        'text'    => 'Sliders',
        'icon'    => 'fa fa-sliders',
        'submenu' => [
            [
                'sref' => 'app.sliders-index',
                'text' => 'Danh sách ảnh',
            ],
            [
                'sref' => 'app.sliders-create',
                'text' => 'Thêm ảnh',
            ],
        ],
    ),
    array(
        'text'    => 'Banner',
        'icon'    => 'icon-badge',
        'submenu' => [
            [
                'sref' => 'app.advertisements-index',
                'text' => 'Danh banner',
            ],
            [
                'sref' => 'app.advertisements-create',
                'text' => 'Thêm banner',
            ],
        ],
    ),
    array(
        'text'    => 'Di sản',
        'icon'    => 'icon-diamond',
        'submenu' => [
            [
                'sref' => 'app.heritages-index',
                'text' => 'Danh sách di sản',
            ],
            [
                'sref' => 'app.heritages-create',
                'text' => 'Thêm di sản',
            ],
        ],
    ),
   /* array(
        'text' => 'Cài đặt',
        'icon' => 'fa fa-cogs',
        'sref' => 'app.configs-index',
    ),*/
        array(
            'text' => 'Tài khoản',
            'icon' => 'icon-people icon-user',
            'submenu' => [
                [
                    'sref' => 'app.users-index',
                    'text' => 'Danh sách tài khoản'
                ],
                [
                    'sref' => 'app.users-create',
                    'text' => 'Thêm tài khoản'
                ]
            ]
        )
);