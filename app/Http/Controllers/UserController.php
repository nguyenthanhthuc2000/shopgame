<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    /**
     * Summary of index
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('pages.profile');
    }
}
