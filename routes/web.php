<?php

use Rap2hpoutre\LaravelLogViewer\LogViewerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountTransactionController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Admin\BankTransactionController as AdminBankTransactionController;
use App\Http\Controllers\Admin\CardTransactionController as AdminCardTransactionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\AccountTransactionController as AdminAccountTransactionController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsAdminOrSeller;
use App\Http\Middleware\LogRequestMiddleware;

Route::get('/dang-nhap/google', [GoogleController::class, 'redirectToGoogle'])->name('redirectToGoogle');
Route::get('/dang-nhap/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('handleGoogleCallback');

Route::get('/chinh-sach', [GoogleController::class, 'index']);
Route::get('/dieu-khoan', [GoogleController::class, 'index']);

Route::middleware([LogRequestMiddleware::class])->group(function () {
    Route::match(['get', 'post'], '/nap-the-cao/callback-the', [CardController::class, 'callbackCard'])->name('callbackCard');
});
Route::middleware(['throttle:300,1'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/nap-the-cao', [CardController::class, 'index'])->name('card.index')->middleware('auth');
    Route::get('/dich-vu', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/nap-tien', [HomeController::class, 'deposit'])->name('home.deposit')->middleware('auth');
    Route::get('/dang-ky', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::get('/dang-nhap', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/dang-nhap', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/dang-ky', [AuthController::class, 'register'])->name('auth.register');
    Route::get('/dang-xuat', action: [AuthController::class, 'logout'])->name('auth.logout');

    Route::group(['prefix' => 'nick-game'], function () {
        Route::get('/', [CategoryController::class, 'list'])->name('category.list');
        Route::get('/{category}', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/{category}/{account}', [AccountController::class, 'show'])->name('account.show');
    });

    Route::middleware([LogRequestMiddleware::class])->group(function () {
        Route::group(['middleware' => ['auth', IsAdminOrSeller::class]], function () {
            Route::get('/tai-khoan-da-ban', [AccountTransactionController::class, 'sellHistory'])->name('account.sell.history');
        });
        Route::group(['prefix' => 'quan-ly-nick-ngoc-rong', 'middleware' => ['auth', IsAdminOrSeller::class]], function () {
            Route::get('/', [AccountController::class, 'index'])->name('account.manage.index');
            Route::post('/', [AccountController::class, 'store'])->name('account.create.post');
            Route::get('/them-moi', [AccountController::class, 'create'])->name('account.create');
            Route::put('/{account}', [AccountController::class, 'update'])->name('account.edit.post');
            Route::get('/{account}/chinh-sua', [AccountController::class, 'edit'])->name('account.edit');
            Route::patch('/{account}/chinh-sua', [AccountController::class, 'update'])->name('account.edit.post');
            Route::delete('/{account}', [AccountController::class, 'destroy'])->name('account.delete');
        });

        Route::group(['middleware' => ['auth']], function () {
            Route::get('/doi-mat-khau', [AuthController::class, 'changePassword'])->name('auth.change.password');
            Route::post('/doi-mat-khau', [AuthController::class, 'updatePassword'])->name('auth.update.password');
            Route::get('/thong-tin-tai-khoan', [UserController::class, 'index'])->name('profile.index');
            Route::get('/tai-khoan-da-mua', [AccountTransactionController::class, 'index'])->name('account.tran.index');
            Route::post('/nap-the-cao/gui-the', [CardController::class, 'postCard'])->name('postCard');
            Route::get('/mua-nick/{account}', [AccountTransactionController::class, 'buyNick'])->name('account.buy');
        });

        Route::group(['prefix' => 'admin', 'middleware' => [IsAdmin::class, 'auth']], function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
            Route::get('logs', [LogViewerController::class, 'index']);
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
