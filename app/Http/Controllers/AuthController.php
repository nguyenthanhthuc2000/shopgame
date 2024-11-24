<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;


class AuthController extends Controller
{
    /**
     * ShowLoginForm
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }


    /**
     * Login
     * 
     * @param LoginRequest $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->status !== User::ACTIVE_STATUS) {
                Auth::logout();
                return back()->withInput()->withErrors([
                    'error' => 'Tài khoản của bạn đã bị khóa.',
                ]);
            }

            return redirect()->route('home');
        }

        return back()->withInput()->withErrors([
            'error' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }


    /**
     * Register
     * 
     * @param \App\Http\Requests\RegisterRequest $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'status' => User::ACTIVE_STATUS,
            'role' => 'buyer',
            'seller_to_buyer_rate' => 70,
            'profit_rate' => 70,
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    /**
     * Đăng xuất người dùng.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();

        // Hủy bỏ tất cả các session liên quan đến người dùng
        session()->invalidate();

        // Tạo lại session token để bảo mật
        session()->regenerateToken();

        return redirect()->route('login');
    }
}
