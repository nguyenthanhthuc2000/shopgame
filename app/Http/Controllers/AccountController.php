<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function index()
    {
        return 'this is a list of accounts';
    }

    public function show($id)
    {
        dd($id);
    }

    public function create(Request $request)
    {
        return 'this is create account page';
    }

    public function store(Request $request)
    {
        //
    }
}
