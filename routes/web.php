<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\BankTransactionController as AdminBankTransactionController;
use App\Http\Controllers\Admin\CardTransactionController as AdminCardTransactionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/detail', [App\Http\Controllers\HomeController::class, 'detail'])->name('detail');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'product'])->name('product');

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

Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/users', [AdminUserController::class, 'index'])->name('users.index');
Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
Route::get('/admin/bank-transactions', [AdminBankTransactionController::class, 'index'])->name('banks.tran.index');
Route::get('/admin/card-transactions', [AdminCardTransactionController::class, 'index'])->name('cards.tran.index');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::post('/bank-transactions', [AdminBankTransactionController::class, 'store'])->name('banks.tran.store');
    Route::get('/bank-transactions/create', [AdminBankTransactionController::class, 'create'])->name('banks.tran.create');
})->middleware(IsAdmin::class);
