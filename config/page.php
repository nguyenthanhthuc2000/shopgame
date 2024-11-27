<?php

return [
    'main_menu' => [
        [
            'name' => 'Trang Chủ',
            'route_name' => 'home'
        ],
        [
            'name' => 'Shop acc',
            'route_name' => 'home.deposit'
        ],
        [
            'name' => 'Nạp thẻ cào',
            'route_name' => 'card.index',
        ],
        // [
            // 'name' => 'Dịch vụ',
            // 'route_name' => 'services.list',
            // 'sub-menu' => [
            //     [
            //         'name' => 'Săn đệ',
            //         'route_name' => 'service.list',
            //         'divider' => false,
            //     ],
            // ]
        // ],
        [
            'name' => 'Giới thiệu',
            'route_name' => 'services.list',
        ],
    ],
];
