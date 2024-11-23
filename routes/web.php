<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\BankTransactionController as AdminBankTransactionController;
use App\Http\Controllers\Admin\CardTransactionController as AdminCardTransactionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/card', [App\Http\Controllers\HomeController::class, 'card'])->name('card');
Route::get('/detail', [App\Http\Controllers\HomeController::class, 'detail'])->name('detail');

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

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'auth.session']], function () {
    Route::get('/bank-transaction', [AdminBankTransactionController::class, 'index'])->name('bank.tran.list');
    Route::get('/bank-transaction/create', [AdminBankTransactionController::class, 'create'])->name('bank.tran.create');
    Route::post('/bank-transaction', [AdminBankTransactionController::class, 'store'])->name('bank.tran.store');
});

Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    Route::get('/bank-transactions', [AdminBankTransactionController::class, 'index'])->name('bank.tran.list');
    Route::get('/bank-transactions/create', [AdminBankTransactionController::class, 'create'])->name('bank.tran.create');
    Route::post('/bank-transactions', [AdminBankTransactionController::class, 'store'])->name('bank.tran.store');

    Route::get('/card-transactions', [AdminCardTransactionController::class, 'index'])->name('card.tran.list');

    Route::get('/users', [AdminUserController::class, 'index'])->name('user.list');
})->middleware(IsAdmin::class);
