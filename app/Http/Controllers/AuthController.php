<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ChangePasswordRequest;

class AuthController extends Controller
{
    /**
     * Show login form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        return view("pages.auth.login");
    }

    /**
     * Show register form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showRegisterForm()
    {
        return view("pages.auth.register");
    }

    /**
     * Show change password form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function changePassword()
    {
        return view('pages.auth.change-password');
    }

    /**
     * Update password
     *
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công, vui lòng đăng nhập lại!');
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
        $remember = $request->boolean('remember', false);

        if (Auth::attempt($credentials, $remember)) {
            if (Auth::user()->status !== User::ACTIVE_STATUS) {
                Auth::logout();
                return back()->withErrors([
                    'error' => 'Tài khoản của bạn đã bị khóa!',
                ]);
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'error' => 'Thông tin không chính xác!',
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
        $user = new User();
        $user->uuid = Str::uuid()->toString();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->status = User::ACTIVE_STATUS;
        $user->role = 'buyer';
        $user->seller_to_buyer_rate = 70;
        $user->profit_rate = 70;
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Auth::login($user);
        
        return redirect()->route('home');
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    }
}
