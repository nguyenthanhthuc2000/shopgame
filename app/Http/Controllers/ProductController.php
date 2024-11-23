<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product()
    {
        $productList = [
            [
                'id' => 1,
                'account_image' => 'https://avatarqn.com/assets/img/NickAvatar2D/5G0ld-bia.png',
                'account_name' => 'account 1',
                'account_price' => '750',
            ],
            [
                'id' => 2,
                'account_image' => 'https://avatarqn.com/assets/img/NickAvatar2D/5G0ld-bia.png',
                'account_name' => 'account 2',
                'account_price' => '250',
            ],
            [
                'id' => 3,
                'account_image' => 'https://avatarqn.com/assets/img/NickAvatar2D/5G0ld-bia.png',
                'account_name' => 'account 3',
                'account_price' => '150',
            ],
            [
                'id' => 4,
                'account_image' => 'https://avatarqn.com/assets/img/NickAvatar2D/5G0ld-bia.png',
                'account_name' => 'account 4',
                'account_price' => '750',
            ],
            [
                'id' => 1,
                'account_image' => 'https://avatarqn.com/assets/img/NickAvatar2D/5G0ld-bia.png',
                'account_name' => 'account 5',
                'account_price' => '250',
            ],
            [
                'id' => 2,
                'account_image' => 'https://avatarqn.com/assets/img/NickAvatar2D/5G0ld-bia.png',
                'account_name' => 'account 6',
                'account_price' => '150',
            ],
            [
                'id' => 3,
                'account_image' => 'https://avatarqn.com/assets/img/NickAvatar2D/5G0ld-bia.png',
                'account_name' => 'account 7',
                'account_price' => '250',
            ],
            [
                'id' => 4,
                'account_image' => 'https://avatarqn.com/assets/img/NickAvatar2D/5G0ld-bia.png',
                'account_name' => 'account 8',
                'account_price' => '150',
            ],

        ];
        return view('pages.product', compact('productList'));
    }
}