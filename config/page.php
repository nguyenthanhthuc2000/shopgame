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
];
