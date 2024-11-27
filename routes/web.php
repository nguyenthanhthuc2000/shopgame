<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountTransactionController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\BankTransactionController as AdminBankTransactionController;
use App\Http\Controllers\Admin\CardTransactionController as AdminCardTransactionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\AccountTransactionController as AdminAccountTransactionController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use \App\Http\Middleware\LogRequestMiddleware;

Route::middleware(['throttle:30,1'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/nap-the-cao', [CardController::class, 'index'])->name('card.index');
    Route::get('/nap-tien', [HomeController::class, 'deposit'])->name('home.deposit');

    Route::group(['prefix' => 'nick-game'], function () {
        Route::get('/', [App\Http\Controllers\AccountController::class, 'index'])->name('product');
        Route::get('/tao-moi', [App\Http\Controllers\AccountController::class, 'create'])->name('product.create');
        Route::post('/tao-moi', [App\Http\Controllers\AccountController::class, 'store'])->name('product.create.post');
        // Route::get('/{slug}/{uuid}', [App\Http\Controllers\AccountController::class, 'show'])->name('product.show');
    });

    Route::group(['prefix' => 'danh-muc'], function () {
        Route::get('/{slug}', [CategoryController::class, 'index'])->name('category.list');
    });

    Route::get('/dang-nhap', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/dang-nhap', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/dang-ky', [AuthController::class, 'register'])->name('auth.register');
    Route::get('/dang-xuat', [AuthController::class, 'logout'])->name('auth.logout');

    Route::group(["prefix" => 'services'], function () {
        Route::get('/', [AccountController::class, 'index'])->name('services.list');
        Route::get('/{id}', [AccountController::class, 'show'])->name('services.show');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/thong-tin-tai-khoan', [UserController::class, 'index'])->name('profile.index');
        Route::get('/tai-khoan-da-mua', [AccountTransactionController::class, 'index'])->name('account.tran.index');
        Route::get('/nap-the-cao/lich-su', [CardController::class, 'historyCards'])->name('historyCards');
        Route::post('/nap-the-cao/gui-the', [CardController::class, 'postCard'])->name('postCard');
    });

    Route::middleware([LogRequestMiddleware::class])->group(function () {
        Route::group(["prefix" => 'accounts'], function () {
            Route::get('/', [AccountController::class, 'index'])->name('accounts.list');
            Route::get('/{id}', [AccountController::class, 'show'])->name('accounts.show');
            Route::get('/create', [AccountController::class, 'create'])->name('accounts.create');
            Route::post('/create', [AccountController::class, 'store'])->name('accounts.create.post');
        });

        Route::group(["prefix" => 'services'], function () {
            Route::get('/', [AccountController::class, 'index'])->name('services.list');
            Route::get('/{id}', [AccountController::class, 'show'])->name('services.show');
        });

        Route::group(['prefix' => 'admin', 'middleware' => [IsAdmin::class, 'auth']], function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
            Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
            Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
            Route::get('/bank-transactions', [AdminBankTransactionController::class, 'index'])->name('banks.tran.index');
            Route::get('/card-transactions', [AdminCardTransactionController::class, 'index'])->name('cards.tran.index');
            Route::get('/account-transactions', [AdminAccountTransactionController::class, 'index'])->name('accounts.tran.index');
            Route::get('/bank-transactions/create', [AdminBankTransactionController::class, 'create'])->name('banks.tran.create');
            Route::post('/bank-transactions', [AdminBankTransactionController::class, 'store'])->name('banks.tran.store');
        });
    });
});
