<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * User management page
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
