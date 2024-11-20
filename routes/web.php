<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/card', [App\Http\Controllers\HomeController::class, 'card'])->name('card');
Route::get('/detail', [App\Http\Controllers\HomeController::class, 'detail'])->name('detail');
