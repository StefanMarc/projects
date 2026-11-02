<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Models\Post;

// Public routes
// redirect to /posts when accessing the root URL
Route::redirect('/', '/posts');

Route::controller(PostController::class)->group(function () {
    // Index
    Route::get('/posts', 'index')->name('posts.index');

    // Showing single post
    Route::get('/posts/{post}', 'show')->whereNumber('post')->name('posts.show');
});

// Protected routes
Route::middleware(['auth'])->group(function () {

    // PostController routes
    Route::controller(PostController::class)->group(function () {
        // Route to show the posts of the currently authenticated user
        Route::get('/posts/my', 'myPosts')->name('my.posts');

        // Creating and storing posts
        Route::get('/posts/create', 'create')->name('posts.create');
        Route::post('/posts', 'store')->name('posts.store');

        // Editing, updating, and deleting posts
        Route::get('/posts/{post}/edit', 'edit')->name('posts.edit');
        Route::put('/posts/{post}', 'update')->name('posts.update');
        Route::delete('/posts/{post}', 'destroy')->name('posts.destroy');
    });

    // CategoryController routes
    Route::controller(CategoryController::class)->group(function () {
        // Index
        Route::get('/categories', 'index')->name('categories.index');
        // Creating and storing categories
        Route::post('/categories', 'store')->name('categories.store');
        // Deleting categories
        Route::delete('/categories/{category}', 'destroy')->name('categories.destroy');
    });
    
    // CommentController routes
    Route::post('/posts/{post}', [CommentController::class, 'store'])->name('comment.store');

    // User premium settings routes
    Route::controller(UserController::class)->group(function () {
        Route::get('/premium/{user}', 'edit')->name('premium');
        Route::put('/premium/{user}', 'update')->name('user.upgrade');
    });
});

// User authentication routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
});