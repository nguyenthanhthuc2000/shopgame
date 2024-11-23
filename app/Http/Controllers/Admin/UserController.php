<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Trang dashboard
     * 
     * @param Request $request
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'DESC')
            ->filterByEmail($request->input('email'))
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.user.index', compact([
            'users',
        ])); 
    }
}
