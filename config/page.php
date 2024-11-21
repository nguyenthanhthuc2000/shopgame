<?php

return [
    'main_menu' => [
        [
            'name' => 'Trang Chủ',
            'route_name' => 'home'
        ],
        [
            'name' => 'Shop acc',
            'route_name' => 'accounts.list'
        ],
        [
            'name' => 'Dịch vụ',
            'route_name' => 'services.list',
            // 'children' => [
            //     [
            //         'name' => 'Săn đệ',
            //         'route_name' => 'service.list'
            //     ],
            // ]
        ],
        // [
        //     'name' => 'Về chúng tôi',
        //     'route_name' => 'about.list',
        // ],
    ],
];
