<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Summary of index
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

        return view('pages.home', compact('categories', 'services'));
    }

    public function deposit()
    {
        return view('pages.deposit');
    }
}