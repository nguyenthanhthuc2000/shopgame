<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\BankTransactionController as AdminBankTransactionController;
use App\Http\Controllers\Admin\CardTransactionController as AdminCardTransactionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\AccountTransactionController as AdminAccountTransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use \App\Http\Middleware\LogRequestMiddleware;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/detail', [App\Http\Controllers\HomeController::class, 'detail'])->name('detail');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'product'])->name('product');

Route::get('/dang-nhap', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/dang-ky', [AuthController::class, 'showRegisterForm']);
Route::post('/dang-ky', [AuthController::class, 'register']);
Route::post('/dang-xuat', [AuthController::class, 'logout']);

Route::group(["prefix" => 'services'], function () {
    Route::get('/', [AccountController::class, 'index'])->name('services.list');
    Route::get('/{id}', [AccountController::class, 'show'])->name('services.show');
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

    Route::group(['prefix' => 'admin', 'middleware' => []], function () {
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
