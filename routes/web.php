<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;

Route::post('/subscribe/toggle', [SubscriptionController::class, 'toggle'])->name('subscribe.toggle');

Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/about_us', [PageController::class, 'about'])->name('about_us');
    Route::get('/dashboard/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('dashboard.show');
    Route::post('/repository/{id}/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/like/{repository}', [LikeController::class, 'toggle'])->name('like.toggle');



    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/create-repo', [ProfileController::class, 'createRepo'])->name('profile.createRepo');
    Route::post('/profile/create-repo', [ProfileController::class, 'storeRepo'])->name('profile.storeRepo');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/profile/repository/{repo}', [App\Http\Controllers\ProfileController::class, 'destroyRepo'])->name('profile.repo.destroy');
    Route::get('/profile/{user}/followers', [ProfileController::class, 'followers'])->name('profile.followers');
    Route::get('/profile/{user}/following', [ProfileController::class, 'following'])->name('profile.following');
    Route::delete('/profile/follow/{subscription}', [ProfileController::class, 'destroyFollow'])->name('profile.deleteFollow');
    Route::post('/follow/{user}', [ProfileController::class, 'follow'])->name('user.follow');
    Route::delete('/unfollow/{user}', [ProfileController::class, 'unfollow'])->name('user.unfollow');

    Route::get('/admin/panel', [AdminController::class, 'index'])->name('admin.panel');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/repositories', [AdminController::class, 'repositories'])->name('admin.repositories');
    Route::delete('/admin/user/{user}', [AdminController::class, 'destroyUser'])->name('admin.user.delete');
    Route::delete('/admin/repository/{repo}', [AdminController::class, 'destroyRepo'])->name('admin.repo.delete');
    Route::get('/admin/posts', [App\Http\Controllers\AdminController::class, 'posts'])->name('admin.posts');
    Route::delete('/admin/posts/{post}', [App\Http\Controllers\AdminController::class, 'destroyPost'])->name('admin.post.delete');

    Route::get('/users', [clientController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [clientController::class, 'show'])->name('users.show');

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/like-post/{post}', [App\Http\Controllers\LikeController::class, 'togglePostLike'])->name('like.post');
    Route::post('/post/{post}/comment', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
});
