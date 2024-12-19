<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    /**
     * ShowLoginForm
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        return view("pages.auth.login");
    }

    /**
     * Summary of changePassword
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function changePassword()
    {
        return view('pages.auth.change-password');
    }

    /**
     * Summary of updatePassword
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
                return response()->json([
                    'success' => false,
                    'message' => 'Tài khoản của bạn đã bị khóa.',
                ], 401);
            }

            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Thông tin không chính xác.',
        ], 401);
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

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký thành công!',
        ]);
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
