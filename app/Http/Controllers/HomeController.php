<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\AccountTransaction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Home page
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::withCount([
            'soldAccounts as sold_count',
            'unsoldAccounts as unsold_count',
        ])->orderBy('id', 'DESC')->get();

        $services = Service::get();
        $accounts = AccountTransaction::with(['user', 'account.category'])
            ->orderBy('id', 'DESC')
            ->limit(5)
            ->get();

        return view('pages.home', compact(['categories', 'services', 'accounts']));
    }

    /**
     * Deposit page
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function deposit()
    {
        return view('pages.deposit');
    }
}