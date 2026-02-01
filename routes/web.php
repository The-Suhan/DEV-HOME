<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;

Route::post('/subscribe/toggle', [SubscriptionController::class, 'toggle'])->name('subscribe.toggle');

Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/dashboard/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('dashboard.show');

    Route::post('/like/{repository}', [LikeController::class, 'toggle'])->name('like.toggle');


    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete');

    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/create-repo', [ProfileController::class, 'createRepo'])->name('profile.createRepo');
    Route::post('/profile/create-repo', [ProfileController::class, 'storeRepo'])->name('profile.storeRepo');

    Route::get('/admin/panel', [AdminController::class, 'index'])->name('admin.panel');
    Route::delete('/admin/user/{user}', [AdminController::class, 'destroy'])->name('admin.user.delete');

    Route::post('/repository/{id}/comment', [CommentController::class, 'store'])->name('comment.store');

    Route::get('/users', [clientController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [clientController::class, 'show'])->name('users.show');

});
