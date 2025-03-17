<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    /**
     * Profile page
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('pages.profile');
    }
}
