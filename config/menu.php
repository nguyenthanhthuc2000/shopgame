<?php

return [
    'main_menu' => [
        [
            'name' => 'TRANG CHỦ',
            'route_name' => 'home',
            'is_login' => false,
        ],
        [
            'name' => 'Danh mục GAME',
            'route_name' => 'category.list',
            'is_login' => false,
        ],
        [
            'name' => 'DỊCH VỤ',
            'route_name' => 'service.index',
            'is_login' => false,
        ],
        [
            'name' => 'NẠP TIỀN',
            'route_name' => 'home.deposit',
            'is_login' => true,
            'sub-menu' => [
                [
                    'name' => 'NẠP TIỀN ATM - VÍ ĐIỆN TỬ',
                    'route_name' => 'home.deposit',
                ],
                [
                    'name' => 'NẠP THẺ CÀO',
                    'route_name' => 'card.index',
                ],
            ]
        ],
        // [
        //     'name' => 'Giới thiệu',
        //     'route_name' => 'services.list',
        //     'divider' => false,
        // ],
    ],

    'user_menu' => [
        [
            'name' => 'Quản lí bán hàng',
            'route_name' => 'account.manage.index',
            'icon_class' => 'fa-solid fa-list',
            'is_seller' => true,
        ],
        [
            'name' => 'Thông tin tài khoản',
            'route_name' => 'profile.index',
            'icon_class' => 'fa-solid fa-id-card',
            'is_seller' => false,
        ],
        [
            'name' => 'Đổi mật khẩu',
            'route_name' => 'auth.change.password',
            'icon_class' => 'fa-solid fa-key',
            'is_seller' => false,
        ],
        [
            'name' => 'Đăng xuất',
            'route_name' => 'auth.logout',
            'icon_class' => 'fa-solid fa-right-from-bracket',
            'is_seller' => false,
            'divider' => false,
        ],
    ],

    'sub_menu' => [
        [
            'title' => 'NICK GAME',
            'is_seller' => true,
            'is_login' => false,
            'is_show' => true,
            'menu_item' => [
                [
                    'name' => 'Game Ngọc Rồng',
                    'route_name' => 'account.manage.index',
                ]
            ],
        ],
        [
            'title' => 'GIAO DỊCH',
            'is_seller' => false,
            'is_login' => true,
            'is_show' => true,
            'menu_item' => [
                [
                    'name' => 'Tài khoản đã mua',
                    'is_seller' => false,
                    'route_name' => 'account.tran.index',
                ],
                [
                    'name' => 'Tài khoản đã bán',
                    'is_seller' => false,
                    'route_name' => 'account.sell.history',
                ]
            ],
        ],
        [
            'title' => 'TÀI KHOẢN',
            'is_seller' => false,
            'is_login' => true,
            'is_show' => true,
            'menu_item' => [
                [
                    'name' => 'Thông tin tài khoản',
                    'route_name' => 'profile.index',
                ],
                [
                    'name' => 'Nạp thẻ cào',
                    'route_name' => 'card.index',
                ],
                [
                    'name' => 'Nạp ATM - Ví điện tử',
                    'route_name' => 'home.deposit',
                ],
                [
                    'name' => 'Đổi mật khẩu',
                    'route_name' => 'auth.change.password',
                ],
                [
                    'name' => 'Đăng xuất',
                    'route_name' => 'auth.logout',
                ]
            ],
        ],
    ],
];
