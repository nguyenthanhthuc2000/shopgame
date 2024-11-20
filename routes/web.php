<?php

use App\Http\Controllers\Admin\BankTransactionController as AdminBankTransactionController;
use App\Http\Controllers\Admin\CardTransactionController as AdminCardTransactionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/card', [App\Http\Controllers\HomeController::class, 'card'])->name('card');
Route::get('/detail', [App\Http\Controllers\HomeController::class, 'detail'])->name('detail');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/bank-transaction', [AdminBankTransactionController::class, 'index'])->name('bank.tran.list');
    Route::get('/bank-transaction/create', [AdminBankTransactionController::class, 'create'])->name('bank.tran.create');
    Route::post('/bank-transaction', [AdminBankTransactionController::class, 'store'])->name('bank.tran.store');

    Route::get('/card-transaction', [AdminCardTransactionController::class, 'index'])->name('card.tran.list');

    Route::get('/users', [AdminUserController::class, 'index'])->name('user.list');
})->middleware(IsAdmin::class);
