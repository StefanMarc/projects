<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Models\Post;

// We voegen ook een redirect toe aan de routes die de hoofdpagina doorverwijst naar de '/posts' route
Route::redirect('/', '/posts');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// DOES NOT WORK!
Route::get('/posts/{user}', [PostController::class, 'myPosts'])->middleware(['auth'])->name('my.posts');

// Use a dedicated users route to enable route model binding without colliding
// with the `/posts/{post}` parameter route or static segments like `/posts/create`.
Route::get('/users/{user}/posts', [PostController::class, 'myPosts'])->name('my.posts');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Route::get('/posts/{id}/edit', function () {})->name('posts.edit');

// Route::put('/posts/{id}', function () {})->name('posts.update');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');


// COMMENT CONTROLLER ROUTER

Route::post('/posts/{post}', [CommentController::class, 'store'])->name('comment.store');

// USER AND SIGN-IN

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');