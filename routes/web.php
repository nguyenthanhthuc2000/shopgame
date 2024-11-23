<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\BankTransactionController as AdminBankTransactionController;
use App\Http\Controllers\Admin\CardTransactionController as AdminCardTransactionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/detail', [App\Http\Controllers\HomeController::class, 'detail'])->name('detail');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'product'])->name('product');

Route::group(["prefix" => 'accounts'], function () {
    Route::get('/{id}', [AccountController::class, 'show'])->name('accounts.show');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'auth.session']], function () {
    Route::get('/bank-transaction', [AdminBankTransactionController::class, 'index'])->name('bank.tran.list');
    Route::get('/bank-transaction/create', [AdminBankTransactionController::class, 'create'])->name('bank.tran.create');
    Route::post('/bank-transaction', [AdminBankTransactionController::class, 'store'])->name('bank.tran.store');
});
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/bank-transactions', [AdminBankTransactionController::class, 'index'])->name('bank.tran.list');
    Route::get('/bank-transactions/create', [AdminBankTransactionController::class, 'create'])->name('bank.tran.create');
    Route::post('/bank-transactions', [AdminBankTransactionController::class, 'store'])->name('bank.tran.store');

    Route::get('/card-transactions', [AdminCardTransactionController::class, 'index'])->name('card.tran.list');

    Route::get('/users', [AdminUserController::class, 'index'])->name('user.list');
})->middleware(IsAdmin::class);