<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $accountsList = [
            [
                'id' => 1,
                'account_image' => 'https://avatarqn.com/assets/img/NickAvatar2D/5G0ld-bia.png',
                'account_name' => 'account',
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
        ];
        return view('pages.home', compact('accountsList'));
    }
    public function detail()
    {
        return view('pages.detail');
    }
}