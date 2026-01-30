<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SubscriptionController;

Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('dashboard.show');
});
Route::post('/like/toggle', [LikeController::class, 'toggleLike'])->name('like.toggle');
Route::post('/subscribe/toggle', [SubscriptionController::class, 'toggle'])->name('subscribe.toggle');
